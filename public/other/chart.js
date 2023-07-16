async function getCharts()
        {
            $.ajax({
                url: '/api/charts',
                type: "GET",
                success: (res) => {
                    $('.loader').hide()
                    let coupons = [res.coupons.unused, res.coupons.used]
                    $('.tt_rev').html(res.total_revenue.toLocaleString('en-NG', {style:"currency", currency: "NGN"}))
                    $('.tt_purchases').html(res.total_purchases)
                    $('.tt_used').html(res.coupons.used)
                    $('.tt_unused').html(res.coupons.unused)
                    var pieChartCanvas = $("#pieChart");
                    var pieChart = new Chart(pieChartCanvas, {
                        type: 'pie',
                        data: {
                        datasets: [{
                            data: coupons,
                            backgroundColor: [
                            '#3F51B5',
                            '#f8ac5a',
                            '#00c2b2',
                            '#f15050'
                            ],
                            borderColor: [
                            '#3F51B5',
                            '#f8ac5a',
                            '#00c2b2',
                            '#f15050'
                            ],
                        }],

                        // These labels appear in the legend and in the tooltips when hovering different arcs
                        labels: [
                            'Unused',
                            'used',
                        ]
                        },
                        options: {
                        responsive: true,
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                        }
                    });

                    var courses = [];
                    var course_students = []

                    console.log(res.courses)
                    res.courses.map(function (course) {
                        courses.push(course.slug);
                        course_students.push(course.user_count);
                    })

                    //console.log(course_students)

                    var currentChartCanvas = $("#barChart").get(0).getContext("2d");
                    var currentChart = new Chart(currentChartCanvas, {
                        type: 'bar',
                        data: {
                        labels: courses,
                        datasets: [{
                            label: 'Users',
                            data: course_students,
                            backgroundColor: '#2ac14e'
                            }
                        ]
                        },
                        options: {
                        responsive: true,
                        maintainAspectRatio: true,

                        scales: {
                            yAxes: [{
                            display: false,
                            gridLines: {
                                drawBorder: false,
                            },
                            ticks: {
                                fontColor: "#686868"
                            }
                            }],
                            xAxes: [{
                            ticks: {
                                fontColor: "#686868"
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            }
                            }]
                        },
                        elements: {
                            point: {
                            radius: 0
                            }
                        }
                        }
                    });
                }
            })
        }
        getCharts()

        $('.reload').click(async function () {
            await getCharts()
        })
