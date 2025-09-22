<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Controllers\Controller;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Services\Mutual\HelperService;
use App\Http\Traits\GeneralTrait;
use App\Repository\StructureRepositoryInterface;
use Illuminate\Http\Request;

use function App\Http\Helpers\array_merge_recursive_distinct;

abstract class StructureController extends Controller
{
  use GeneralTrait;

    protected string $contentKey;

    protected array $locales;

    protected StructureRepositoryInterface $structureRepository;

    protected FileManagerService $fileManager;

    protected HelperService $helper;

    public function __construct(
        StructureRepositoryInterface $structureRepository,
        FileManagerService $fileManagerService,
        HelperService $helper,
        private readonly GetService $getService,
    ) {

        $this->structureRepository = $structureRepository;
        $this->fileManager = $fileManagerService;
        $this->helper = $helper;
    }

    final public function index()
    {
        $content = json_decode((string) $this->structureRepository->structure($this->contentKey)?->content, true);

        return view('dashboard.site.structures.'.$this->contentKey, compact('content'));
    }

    public function _store(Request $request)
    {
        $content = $this->build($request);
        $this->structureRepository->publish($this->contentKey, $content);

        return redirect()->back()->with('success', __('messages.created successfully'));
    }

    private function build($request)
    {
        $data = $this->file($request);

        $result = [];
        foreach ($data as $locale => $content) {

            if (in_array($locale, $this->locales)) {
                $result[$locale] = $content;
                if (isset($data['all'])) {
                    $result[$locale] = array_merge_recursive_distinct($result[$locale], $data['all']);
                }
            }
        }

        $safe_array = $this->helper->safeArray($result);

        $safe_json = $this->helper->safeJson($safe_array);

        return json_encode($safe_json);
    }

    private function file($request)
    {
        $data = $request->all();
        if (isset($data['old_file'])) {
            if (is_array($data['old_file'])) {
                foreach ($data['old_file'] as $i => $oldFile) {
                    $oldFilePath = str_replace(url('/'), '', $oldFile);
                    if (is_array($request->file('file')) && isset($request->file('file')[$i])) {
                        $this->fileManager->deleteFile($oldFilePath);

                        $filePath = $this->fileManager->upload('file.'.$i, 'content/'.$this->contentKey);

                        $this->assignFilesUrls($data, 'file_'.$i, url($filePath));
                    } else {
                        $this->assignFilesUrls($data, 'file_'.$i, url($oldFilePath));
                    }
                }
            }
        }

        return $data;
    }

    private function assignFilesUrls(&$data, $search, $replace)
    {
        foreach ($data as &$value) {
            if (is_array($value)) {
                $this->assignFilesUrls($value, $search, $replace);
            } elseif ($value == $search) {
                $value = $replace;
            }
        }
    }
}
