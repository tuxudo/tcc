<?php $this->view('partials/head'); ?>

<div class="container">
  <div class="row">
  	<div class="col-lg-12">
	<h3><span data-i18n="tcc.report"></span> <span id="total-count" class='label label-primary'>…</span></h3>

		  <table class="table table-striped table-condensed table-bordered">
		    <thead>
		      <tr>
		      	<th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
		        <th data-i18n="serial" data-colname='reportdata.serial_number'></th>
		        <th data-i18n="tcc.client" data-colname='tcc.client'></th>
		        <th data-i18n="tcc.service" data-colname='tcc.service'></th>
		        <th data-i18n="tcc.allowed" data-colname='tcc.allowed'></th>
		        <th data-i18n="tcc.last_modified" data-colname='tcc.last_modified'></th>
		        <th data-i18n="tcc.prompt_count" data-colname='tcc.prompt_count'></th>
		        <th data-i18n="tcc.indirect_object_identifier" data-colname='tcc.indirect_object_identifier'></th>
		        <th data-i18n="tcc.dbpath" data-colname='tcc.dbpath'></th>
		      </tr>
		    </thead>
		    <tbody>
		    	<tr>
		    	     <td data-i18n="listing.loading" colspan="9" class="dataTables_empty"></td>
		    	</tr>
		    </tbody>
		  </table>
    </div> <!-- /span 13 -->
  </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">

	$(document).on('appUpdate', function(e){

		var oTable = $('.table').DataTable();
		oTable.ajax.reload();
		return;

	});

	$(document).on('appReady', function(e, lang) {

        // Get modifiers from data attribute
        var mySort = [], // Initial sort
            hideThese = [], // Hidden columns
            col = 0, // Column counter
            runtypes = [], // Array for runtype column
            columnDefs = [{ visible: false, targets: hideThese }]; // Column Definitions

        $('.table th').map(function(){

            columnDefs.push({name: $(this).data('colname'), targets: col, render: $.fn.dataTable.render.text()});

            if($(this).data('sort')){
              mySort.push([col, $(this).data('sort')])
            }

            if($(this).data('hide')){
              hideThese.push(col);
            }

            col++
        });

	    oTable = $('.table').dataTable( {
            ajax: {
                url: appUrl + '/datatables/data',
                type: "POST",
                data: function(d){
                    d.mrColNotEmpty = "tcc.dbpath";

                }
            },
            dom: mr.dt.buttonDom,
            buttons: mr.dt.buttons,
            order: mySort,
            columnDefs: columnDefs,
		    createdRow: function( nRow, aData, iDataIndex ) {
	        	// Update name in first column to link
	        	var name=$('td:eq(0)', nRow).html();
	        	if(name == ''){name = "No Name"};
	        	var sn=$('td:eq(1)', nRow).html();
	        	var link = mr.getClientDetailLink(name, sn, '#tab_tcc-tab');
	        	$('td:eq(0)', nRow).html(link);

	        	// Format service
	        	var service=$('td:eq(3)', nRow).html();
	        	$('td:eq(3)', nRow).html(i18n.t('tcc.'+service.replace("kTCCServiceSystemPolicy","").replace("kTCCService","")).replace("tcc.",""))

	        	// Format boolean
	        	var status=$('td:eq(4)', nRow).html();
	        	status = status == 1 ? '<span class="label label-danger">'+i18n.t('yes')+'</span>' :
	        	(status == 0 ? '<span class="label label-success">'+i18n.t('no')+'</span>' : '')
	        	$('td:eq(4)', nRow).html(status)

	        	// Format date
	        	var checkin = parseInt($('td:eq(5)', nRow).html());
                if (checkin > 0){
                    var date = new Date(checkin * 1000);
                    $('td:eq(5)', nRow).html('<span title="'+moment(date).fromNow()+'">'+moment(date).format('llll')+'</span>');
                }
            }
	    } );
	} );
</script>

<?php $this->view('partials/foot')?>
