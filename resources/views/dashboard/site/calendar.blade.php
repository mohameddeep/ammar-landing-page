@extends('dashboard.core.app')
@section('title', __('display_name'))
@section('css_addons')
    <!-- FullCalendar Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/main.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/daygrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/timegrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/list.min.css') }}">
@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('display_name') }}" :breadcrumbs="[
            ['name' => __('dashboard.roles_and_permissions'), 'route' => 'roles.index'],
            ['name' => __('display_name'), 'route' => 'roles.index'],
            ['name' => __('dashboard.Create Admin')],
        ]" />
        <!-- Page Header Close -->
        <div class="row">


            <div class="col-xl-9">
                <x-cards.page-card>

                    <div class="py-2" id='calendar2'></div>

                </x-cards.page-card>
            </div>
            <div class="col-xl-3">
                <x-cards.page-card>
                    <div class="card-header d-grid">
                        <button class="btn btn-primary-light btn-wave"><i
                                class="ri-add-line align-middle me-1 fw-semibold d-inline-block"></i>Create New
                            Event</button>
                    </div>
                    <div id="external-events" class="border-bottom p-3">
                        <div
                            class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-primary border border-primary">
                            <div class="fc-event-main">Calendar Events</div>
                        </div>
                        <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-secondary border border-secondary"
                            data-class="bg-secondary">
                            <div class="fc-event-main">Birthday EVents</div>
                        </div>
                        <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-success border border-success"
                            data-class="bg-success">
                            <div class="fc-event-main">Holiday Calendar</div>
                        </div>
                        <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-info border border-info"
                            data-class="bg-info">
                            <div class="fc-event-main">Office Events</div>
                        </div>
                        <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-warning border border-warning"
                            data-class="bg-warning">
                            <div class="fc-event-main">Other Events</div>
                        </div>
                        <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-danger border border-danger"
                            data-class="bg-danger">
                            <div class="fc-event-main">Festival Events</div>
                        </div>
                        <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-teal border border-teal"
                            data-class="bg-danger">
                            <div class="fc-event-main">Timeline Events</div>
                        </div>
                    </div>
                    <div class="p-3 border-bottom">
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <h6 class="fw-semibold">
                                Activity :
                            </h6>
                            <button class="btn btn-primary-light btn-sm btn-wave">View All</button>
                        </div>
                        <ul class="list-unstyled mb-0 fullcalendar-events-activity" id="full-calendar-activity">
                            <li>
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <p class="mb-1 fw-semibold">
                                        Monday, Jan 1,2023
                                    </p>
                                    <span class="badge bg-light text-default mb-1">12:00PM - 1:00PM</span>
                                </div>
                                <p class="mb-0 text-muted fs-12">
                                    Meeting with a client about new project requirement.
                                </p>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <p class="mb-1 fw-semibold">
                                        Thursday, Dec 29,2022
                                    </p>
                                    <span class="badge bg-success mb-1">Completed</span>
                                </div>
                                <p class="mb-0 text-muted fs-12">
                                    Birthday party of niha suka
                                </p>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <p class="mb-1 fw-semibold">
                                        Wednesday, Jan 3,2023
                                    </p>
                                    <span class="badge bg-warning-transparent mb-1">Reminder</span>
                                </div>
                                <p class="mb-0 text-muted fs-12">
                                    WOrk taget for new project is completing
                                </p>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <p class="mb-1 fw-semibold">
                                        Friday, Jan 20,2023
                                    </p>
                                    <span class="badge bg-light text-default mb-1">06:00PM - 09:00PM</span>
                                </div>
                                <p class="mb-0 text-muted fs-12">
                                    Watch new movie with family
                                </p>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <p class="mb-1 fw-semibold">
                                        Saturday, Jan 07,2023
                                    </p>
                                    <span class="badge bg-danger-transparent mb-1">Due Date</span>
                                </div>
                                <p class="mb-0 text-muted fs-12">
                                    Last day to pay the electricity bill and water bill.need to check the bank details.
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="p-3">
                        <img src="../assets/images/media/media-83.svg" alt="">
                    </div>

                </x-cards.page-card>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>

    <script src="{{ asset('assets/libs/fullcalendar/main.min.js') }}"></script>

    <script src="{{ asset('assets/libs/fullcalendar/interaction.min.js') }}"></script>
    <script src="{{ asset('assets/libs/fullcalendar/daygrid.min.js') }}"></script>
    <script src="{{ asset('assets/libs/fullcalendar/timegrid.min.js') }}"></script>
    <script src="{{ asset('assets/libs/fullcalendar/list.min.js') }}"></script>
    <script src="{{ asset('assets/libs/fullcalendar/bootstrap5.min.js') }}"></script>

    <script>
        (function() {
            "use strict";
            //_____Calendar Events Intialization

            // sample calendar events data
            var curYear = moment().format('YYYY');
            var curMonth = moment().format('MM');

            // قائمة بجميع خصائص الحدث الممكنة
            var eventProperties = {
                // الخصائص الأساسية
                id: 'unique-id',
                groupId: 'group-id', // لتجميع الأحداث معاً
                allDay: false, // أو true إذا كان الحدث طوال اليوم
                start: curYear + '-' + curMonth + '-01T09:00:00', // تاريخ ووقت البداية
                end: curYear + '-' + curMonth + '-01T17:00:00', // تاريخ ووقت النهاية
                startStr: '', // سلسلة نصية لوقت البداية (يتم تعبئتها تلقائياً)
                endStr: '', // سلسلة نصية لوقت النهاية (يتم تعبئتها تلقائياً)
                title: 'عنوان الحدث',
                url: 'https://example.com', // رابط عند النقر على الحدث

                // خصائص التنسيق
                classNames: ['class1', 'class2'], // فئات CSS مخصصة
                backgroundColor: '#ffffff', // لون الخلفية
                borderColor: '#000000', // لون الحدود
                textColor: '#000000', // لون النص
                display: 'auto', // أو 'block'، 'list-item'، 'background'، 'none'

                // خصائص التكرار
                daysOfWeek: [1, 3, 5], // أيام الأسبوع (0=الأحد)
                startTime: '09:00', // وقت البداية للأحداث المتكررة
                endTime: '17:00', // وقت النهاية للأحداث المتكررة
                startRecur: curYear + '-' + curMonth + '-01', // تاريخ بدء التكرار
                endRecur: curYear + '-' + (parseInt(curMonth) + 1) + '-01', // تاريخ انتهاء التكرار

                // خصائص إضافية
                extendedProps: {
                    description: 'وصف مفصل للحدث',
                    location: 'موقع الحدث',
                    organizer: 'منظم الحدث',
                    priority: 'high',
                    customField: 'أي قيمة مخصصة'
                },

                // خصائص السحب والإفلات
                editable: true, // يمكن تحريره
                startEditable: true, // يمكن تحرير وقت البداية
                durationEditable: true, // يمكن تحرير المدة
                resourceEditable: true, // يمكن تغيير المورد

                // خصائص العرض
                overlap: true, // هل يمكن أن يتداخل مع أحداث أخرى
                constraint: 'businessHours', // أو مجموعة من الأحداث
                allow: 'businessHours', // قيود السحب والإفلات
                color: '#ff0000', // لون بديل (يؤثر على backgroundColor وborderColor)

                // خصائص النص
                rendering: 'normal', // أو 'background' أو 'inverse-background'
                interactive: true // هل يمكن التفاعل مع الحدث
            };

            // Calendar Event Source مع جميع الخصائص
            var sptCalendarEvents = {
                id: 1,
                events: [{
                    id: '1',
                    groupId: 'meetings',
                    allDay: false,
                    start: curYear + '-' + curMonth + '-02T10:00:00',
                    end: curYear + '-' + curMonth + '-02T12:00:00',
                    startStr: curYear + '-' + curMonth + '-02T10:00:00',
                    endStr: curYear + '-' + curMonth + '-02T12:00:00',
                    title: 'Spruko Meetup',
                    url: 'https://spruko.com/meetup',
                    classNames: ['important-event', 'team-meeting'],
                    backgroundColor: '#845adf',
                    borderColor: '#845adf',
                    textColor: '#ffffff',
                    display: 'block',
                    extendedProps: {
                        description: 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary',
                        location: 'Conference Room A',
                        organizer: 'John Doe',
                        attendees: ['Alice', 'Bob', 'Charlie']
                    },
                    editable: true,
                    startEditable: true,
                    durationEditable: true,
                    overlap: false,
                    constraint: 'businessHours',
                    rendering: 'normal',
                    interactive: true
                }, {
                    id: '2',
                    groupId: 'reviews',
                    start: curYear + '-' + curMonth + '-17T14:00:00',
                    end: curYear + '-' + curMonth + '-17T15:30:00',
                    title: 'Design Review',
                    backgroundColor: '#23b7e5',
                    borderColor: '#23b7e5',
                    textColor: '#ffffff',
                    extendedProps: {
                        description: 'Review of the new UI design with the team',
                        location: 'Design Studio',
                        priority: 'high'
                    },
                    editable: false
                }, {
                    id: '3',
                    allDay: true,
                    start: curYear + '-' + curMonth + '-13',
                    end: curYear + '-' + curMonth + '-13',
                    title: 'Lifestyle Conference',
                    backgroundColor: '#845adf',
                    borderColor: '#845adf',
                    url: 'https://lifestyle-conf.com',
                    extendedProps: {
                        description: 'Annual lifestyle and wellness conference',
                        location: 'Convention Center',
                        ticketRequired: true
                    }
                }]
            };

            // Birthday Events Source مع خصائص إضافية
            var sptBirthdayEvents = {
                id: 2,
                backgroundColor: '#49b6f5',
                borderColor: '#49b6f5',
                textColor: '#fff',
                events: [{
                    id: '7',
                    start: curYear + '-' + curMonth + '-04',
                    end: curYear + '-' + curMonth + '-04',
                    title: 'Harcates Birthday',
                    allDay: true,
                    classNames: ['birthday-event'],
                    extendedProps: {
                        description: 'Birthday celebration for team member',
                        type: 'birthday',
                        age: 32
                    }
                }, {
                    id: '8',
                    start: curYear + '-' + curMonth + '-28',
                    end: curYear + '-' + curMonth + '-28',
                    title: 'Bunnysin\'s Birthday',
                    allDay: true,
                    backgroundColor: '#ff69b4',
                    extendedProps: {
                        description: 'Office birthday party',
                        cake: 'Chocolate',
                        guests: 15
                    }
                }]
            };

            // Holiday Events Source مع خصائص متقدمة
            var sptHolidayEvents = {
                id: 3,
                backgroundColor: '#e6533c',
                borderColor: '#e6533c',
                textColor: '#fff',
                events: [{
                    id: '10',
                    start: curYear + '-' + curMonth + '-05',
                    end: curYear + '-' + curMonth + '-08',
                    title: 'Festival Day',
                    allDay: true,
                    rendering: 'background',
                    extendedProps: {
                        description: 'National festival holiday',
                        publicHoliday: true,
                        country: 'US'
                    }
                }, {
                    id: '11',
                    start: curYear + '-' + curMonth + '-18',
                    end: curYear + '-' + curMonth + '-19',
                    title: 'Memorial Day',
                    allDay: true,
                    color: '#ff0000', // سيؤثر على backgroundColor وborderColor
                    extendedProps: {
                        description: 'Day to remember and honor',
                        annualEvent: true
                    }
                }]
            };

            // Other Events Source مع خصائص متقدمة
            var sptOtherEvents = {
                id: 4,
                backgroundColor: '#23b7e5',
                borderColor: '#23b7e5',
                textColor: '#fff',
                events: [{
                    id: '13',
                    start: curYear + '-' + curMonth + '-07T09:00:00',
                    end: curYear + '-' + curMonth + '-09T17:00:00',
                    title: 'My Rest Day',
                    display: 'background',
                    extendedProps: {
                        description: 'Personal time off',
                        type: 'vacation',
                        approved: true
                    }
                }, {
                    id: '14',
                    daysOfWeek: [2, 4], // كل ثلاثاء وخميس
                    startTime: '19:00',
                    endTime: '20:30',
                    startRecur: curYear + '-' + curMonth + '-01',
                    endRecur: curYear + '-' + (parseInt(curMonth) + 1) + '-01',
                    title: 'Weekly Yoga Class',
                    extendedProps: {
                        description: 'Relaxing yoga session',
                        instructor: 'Jane Smith',
                        level: 'Intermediate'
                    }
                }]
            };

            //________ FullCalendar
            var containerEl = document.getElementById('external-events');
            new FullCalendar.Draggable(containerEl, {
                itemSelector: '.fc-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText.trim(),
                        className: eventEl.className + ' overflow-hidden',
                        // يمكن إضافة المزيد من الخصائص هنا
                        extendedProps: {
                            source: 'external'
                        }
                    }
                }
            });

            var calendarEl = document.getElementById('calendar2');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                initialDate: curYear + '-' + curMonth + '-01',
                navLinks: true,
                businessHours: {
                    daysOfWeek: [1, 2, 3, 4, 5], // من الاثنين إلى الجمعة
                    startTime: '08:00',
                    endTime: '18:00'
                },
                editable: true,
                selectable: true,
                selectMirror: true,
                droppable: true,
                dayMaxEventRows: true,
                dayMaxEvents: true,
                nowIndicator: true,
                scrollTime: '08:00:00',
                slotMinTime: '06:00:00',
                slotMaxTime: '22:00:00',
                expandRows: true,
                height: 'auto',
                contentHeight: 'auto',
                aspectRatio: 1.8,
                handleWindowResize: true,
                windowResizeDelay: 100,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: 'short'
                },
                eventDisplay: 'auto',
                eventOrder: 'title',
                eventDidMount: function(info) {
                    // يمكن إضافة تأثيرات أو تعديلات عند عرض الحدث
                    console.log('Event mounted:', info.event.title);
                },
                eventWillUnmount: function(info) {
                    // تنظيف أي تأثيرات عند إزالة الحدث
                    console.log('Event unmounted:', info.event.title);
                },
                eventContent: function(arg) {
                    // تخصيص محتوى الحدث
                    return {
                        html: '<div class="custom-event-content">' +
                            '<b>' + arg.event.title + '</b>' +
                            '<p>' + arg.timeText + '</p>' +

                            '</div>'
                    };
                },

                select: function(arg) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.addEvent({
                            title: title,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay,
                            backgroundColor: '#3788d8',
                            borderColor: '#3788d8',
                            textColor: '#ffffff',
                            extendedProps: {
                                createdBy: 'user',
                                creationDate: new Date()
                            }
                        });
                    }
                    calendar.unselect();
                },

                eventClick: function(arg) {
                    var eventObj = arg.event;
                    var modal = `
                    <div class="event-details-modal">
                        <h3>${eventObj.title}</h3>
                        <p><strong>Time:</strong> ${eventObj.start ? eventObj.start.toLocaleString() : ''} 
                        ${eventObj.end ? ' - ' + eventObj.end.toLocaleString() : ''}</p>
                        ${eventObj.extendedProps.description ? 
                          '<p><strong>Description:</strong> ' + eventObj.extendedProps.description + '</p>' : ''}
                        ${eventObj.url ? '<p><a href="' + eventObj.url + '" target="_blank">More Info</a></p>' : ''}
                        <button onclick="this.parentNode.remove()">Close</button>
                        <button onclick="if(confirm('Delete this event?')){${eventObj.remove()}; this.parentNode.remove()}">Delete</button>
                    </div>
                `;

                    var div = document.createElement('div');
                    div.innerHTML = modal;
                    div.style.position = 'fixed';
                    div.style.top = '50%';
                    div.style.left = '50%';
                    div.style.transform = 'translate(-50%, -50%)';
                    div.style.backgroundColor = 'white';
                    div.style.padding = '20px';
                    div.style.zIndex = '1000';
                    div.style.border = '1px solid #ccc';
                    div.style.borderRadius = '5px';

                    document.body.appendChild(div);
                },

                eventSources: [
                    sptCalendarEvents,
                    sptBirthdayEvents,
                    sptHolidayEvents,
                    sptOtherEvents
                ],

                // خيارات متقدمة
                progressiveEventRendering: true,
                eventDragMinDistance: 5,
                dragScroll: true,
                allDayMaintainDuration: true,
                moreLinkClick: 'popover',
                moreLinkContent: function(args) {
                    return '+' + args.num + ' more';
                }
            });


            calendar.render();
            // for activity scroll
            var myElement1 = document.getElementById('full-calendar-activity');
            new SimpleBar(myElement1, {
                autoHide: true
            });

        })();
    </script>
@endpush
