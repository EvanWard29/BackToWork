<?php include_once "header.php";
    //requireLogin();
?>
<html lang="en">
    <head>
        <script src="../assets/js/calendar.js"></script>
        <script src="https://unpkg.com/codeflask/build/codeflask.min.js"></script>

        <link rel="stylesheet" href="page.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="theme.css">
        <link rel="shortcut icon" href="favicon.png">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div class="calendar-wrapper"></div>
        <script type="text/javascript">
            var config =
                `function selectDate(date) {
                  $('.calendar-wrapper').updateCalendarOptions({
                    date: date
                  });
                }

                var defaultConfig = {
                  weekDayLength: 1,
                  date: new Date(),
                  onClickDate: selectDate,
                  showYearDropdown: true,
                  startOnMonday: true,
                };

                $('.calendar-wrapper').calendar(defaultConfig);`;

            eval(config);
            const flask = new CodeFlask('#editor', {
                language: 'js',
                lineNumbers: true
            });
            flask.updateCode(config);
            flask.onUpdate((code) => {
                try {
                    eval(code);
                } catch(e) {}
            });
        </script>
    </body>
</html>