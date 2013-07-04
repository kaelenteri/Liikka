// Datepicker
            $(function() {
                $("#from").datepicker({
                    defaultDate: "+0w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    showWeek: true,
                    dateFormat: 'dd.mm.yy',
                    onClose: function(selectedDate) {
                        $("#to").datepicker("option", "minDate", selectedDate);
                    }
                });
                var alku = new Date();
                alku.setHours(-168);
                $("#from").datepicker("setDate", alku);
                $("#to").datepicker({
                    defaultDate: "+0w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    showWeek: true,
                    dateFormat: 'dd.mm.yy',
                    onClose: function(selectedDate) {
                        $("#from").datepicker("option", "maxDate", selectedDate);
                    }
                });
                var loppu = new Date();
                $("#to").datepicker("setDate", loppu);
            });

//


        $(document).ready(function() {
            $("#suodata").click(function() {
                var rajoitus = $("#rajoitus").val();

                var alku = $("#from").datepicker('getDate');
                alku = $.datepicker.formatDate('yy-mm-dd', alku);

                var loppu = $("#to").datepicker('getDate');
                loppu = $.datepicker.formatDate('yy-mm-dd', loppu);

                var nimi = <?php echo json_encode($_GET['kayttajanimi']); ?>;
                var laji_id = $("#laji").val();
                $.post("suodata.php",
                        {
                            nimi: nimi,
                            alku: alku,
                            loppu: loppu,
                            rajoitus: rajoitus,
                            laji_id: laji_id
                        },
                function(data) {
                    $("#liikuntasuoritukset").html(data);
                });
            });
        });
