<?php include("restringir.php"); ?>
<?php include("acentos.php"); ?>
<?php include("funciones.php"); ?>
<?php
mysql_select_db($database_admin, $admin);
$query_ver = "SELECT * FROM tbl_post ORDER BY id DESC";
$ver = mysql_query($query_ver, $admin) or die(mysql_error());
$row_ver = mysql_fetch_assoc($ver);
$totalRows_ver = mysql_num_rows($ver);
?>
<!doctype html>
<html class="fixed">
	<head>

	<?php include("llamadoshead.php"); ?>
	<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
	<link rel="stylesheet" href="assets/vendor/fullcalendar/fullcalendar.css" />
	<link rel="stylesheet" href="assets/vendor/fullcalendar/fullcalendar.print.css" media="print" />	
	<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include("header.php"); ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include("nav.php");?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Agenda</h2>
					
					</header>

						<section class="panel">
							<header class="panel-heading">
														
								<h2 class="panel-title">Calendario de eventos</h2>
							</header>
							<div class="panel-body">
                            	<div style="margin-bottom:10px;">
									<a href="agenda_nuevo.php" class="mb-xs mt-xs mr-xs btn btn-default">Nueva Entrada</a>
                                    <a href="agenda_lista.php" class="mb-xs mt-xs mr-xs btn btn-default">Ver Lista de Eventos</a>
								</div>
								<div >
									<div id="calendar"></div>
								</div>
							</div>
						</section>
					<!-- end: page -->
				</section>
			</div>

			
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/fullcalendar/lib/moment.min.js"></script>
		<script src="assets/vendor/fullcalendar/fullcalendar.js"></script>
        <script src="assets/vendor/fullcalendar/lang-all.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
        
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		
		<!-- Examples -->
        <script type="text/javascript">
        (function( $ ) {

			'use strict';
		
			var initCalendarDragNDrop = function() {
				$('#external-events div.external-event').each(function() {
		
					// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
					// it doesn't need to have a start or end
					var eventObject = {
						title: $.trim($(this).text()) // use the element's text as the event title
					};
		
					// store the Event Object in the DOM element so we can get to it later
					$(this).data('eventObject', eventObject);
		
					// make the event draggable using jQuery UI
					$(this).draggable({
						zIndex: 999,
						revert: true,      // will cause the event to go back to its
						revertDuration: 0  //  original position after the drag
					});
		
				});
			};
		
			var initCalendar = function() {
				var $calendar = $('#calendar');
				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();
		
				$calendar.fullCalendar({
					lang: 'es',
					header: {
						left: 'title',
						right: 'prev,today,next,basicDay,basicWeek,month'
					},
		
					timeFormat: 'h:mm',
		
					titleFormat: {
						month: 'MMMM YYYY',      // September 2009
						week: "MMM d YYYY",      // Sep 13 2009
						day: 'dddd, MMM d, YYYY' // Tuesday, Sep 8, 2009
					},
		
					themeButtonIcons: {
						prev: 'fa fa-caret-left',
						next: 'fa fa-caret-right',
					},
		
					editable: false,
					droppable: false, // this allows things to be dropped onto the calendar !!!
					drop: function(date, allDay) { // this function is called when something is dropped
						var $externalEvent = $(this);
						// retrieve the dropped element's stored Event Object
						var originalEventObject = $externalEvent.data('eventObject');
		
						// we need to copy it, so that multiple events don't have a reference to the same object
						var copiedEventObject = $.extend({}, originalEventObject);
		
						// assign it the date that was reported
						copiedEventObject.start = date;
						copiedEventObject.allDay = allDay;
						copiedEventObject.className = $externalEvent.attr('data-event-class');
		
						// render the event on the calendar
						// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
						$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
		
						// is the "remove after drop" checkbox checked?
						if ($('#RemoveAfterDrop').is(':checked')) {
							// if so, remove the element from the "Draggable Events" list
							$(this).remove();
						}
		
					},
					events: "agenda_eventos.php"
				});
		
				// FIX INPUTS TO BOOTSTRAP VERSIONS
				var $calendarButtons = $calendar.find('.fc-header-right > span');
				$calendarButtons
					.filter('.fc-button-prev, .fc-button-today, .fc-button-next')
						.wrapAll('<div class="btn-group mt-sm mr-md mb-sm ml-sm"></div>')
						.parent()
						.after('<br class="hidden"/>');
		
				$calendarButtons
					.not('.fc-button-prev, .fc-button-today, .fc-button-next')
						.wrapAll('<div class="btn-group mb-sm mt-sm"></div>');
		
				$calendarButtons
					.attr({ 'class': 'btn btn-sm btn-default' });
			};
		
			$(function() {
				initCalendar();
				initCalendarDragNDrop();
			});
		
		}).apply(this, [ jQuery ]);
        </script>
		
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>
	</body>
</html>