  /****************Create Multiple Modal********************/
  function createNewModal(clicked_btn){
    var layerIdArray = clicked_btn.id.split("_");
    var layerId = parseInt(layerIdArray[1]);
    //Check's if the same id modal already exists or not.
    if($("#myModalBody_" + layerId).length == 0) {
        var newModal = '<div class="modal fade" id="myModalBody_'+layerId+'" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">'+
        '<div class="modal-dialog" role="document">'+
          '<div class="modal-content">'+
            '<div class="modal-header">'+
              '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<h4 class="modal-title" id="myModalLabel">New Group</h4>'+
            '</div>'+
            '<div class="modal-body">'+
              '<form id="form_'+layerId+'">'+
              '<div class="form-group">'+
                '<label>Name</label>'+
                '<input id="group_name_'+layerId+'" name="group_name" type="text" class="form-control" placeholder="Enter name of group" required="required">'+
              '</div>'+
              '<div class="form-group">'+
                '<label>Alias</label>'+
                '<textarea  rows="1" style="resize: vertical" id="group_alias_'+layerId+'" name="group_alias" type="text" class="form-control" placeholder="Enter alias"></textarea>'+
              '</div>'+
              '<div class="form-group">'+
                '<div class="col-6">'+
                  '<label>Nature of Group</label>'+
                  '<p class="input-group">'+
                  '<select id="group_nature_'+layerId+'" name="group_nature" class="form-control select2 group_nature">'+
                  '</select>'+
                  '<span style="padding-left: 2%" class="input-group-btn">'+
                      '<button type="button" class="btn btn-success" id="modalButton_'+(layerId+1)+'" data-toggle="modal" data-target="#myModalBody_'+(layerId+1)+'" onClick="createNewModal(this)"><i class="glyphicon glyphicon-plus"></i></button>'+
                    '</span>'+
                  '</p>'+
                '</div>'+
              '</div>'+
              '<div class="form-group">'+
                '<div class="col-6">'+
                  '<label>Group Status</label><br/>'+
                  '<select id="group_status_'+layerId+'" name="group_status" class="form-control group_status">'+
                  '<option value=1>Deactive</option>'+
                  '<option value=2>Editable</option>'+
                  '<option value=3>Non-editable</option>'+
                  '</select>'+
                '</div>'+
              '</div>'+
              '<div class="form-group">'+
                '<div class="col-6">'+
                  '<label>Group behave as Sub-Ledger</label><br/>'+
                  '<label>'+
                    '<input type="radio" name="is_subleger" id="is_subleger_yes_'+layerId+'" value=1> YES &nbsp;'+
                  '</label>'+
                  '<label>'+
                    '<input type="radio" name="is_subleger" id="is_subleger_no_'+layerId+'" value=0 Checked>NO'+
                  '</label>'+
                '</div>'+
              '</div>'+
              '<div class="form-group">'+
                '<div class="col-6">'+
                  '<label>Nett Debit/Credit Balance for Reporting</label><br/>'+
                  '<label>'+
                    '<input type="radio" name="balance_reporting" id="balance_reporting_yes_'+layerId+'" value=1> YES &nbsp;'+
                  '</label>'+
                  '<label>'+
                    '<input type="radio" name="balance_reporting" id="balance_reporting_no_'+layerId+'" value=0 Checked>NO'+
                  '</label>'+
                '</div>'+
              '</div>'+
              '<div class="form-group">'+
                '<div class="col-6">'+
                  '<label>Used for Calculation (eg. Taxes, Discount)<br/><span style="font-weight: normal;">(for Sales Invoice Entry)</span></label><br/>'+
                  '<label>'+
                    '<input type="radio" name="is_calculation" id="is_calculation_yes_'+layerId+'" value=1> YES &nbsp;'+
                  '</label>'+
                  '<label>'+
                    '<input type="radio" name="is_calculation" id="is_calculation_no_'+layerId+'" value=0 Checked>NO'+
                  '</label>'+
                '</div>'+
              '</div>'+
              '<div class="form-group">'+
                  '<div class="col-6">'+
                    '<label>Method to Allocate when used in Purchase Invoice: <span style="font-weight: normal;">Not Applicable</span></label>'+
                  '</div>'+
              '</div>'+
              '</form>'+
            '</div>'+
            '<div class="modal-footer">'+
              '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
              '<button type="button" id="group_data_submit_'+layerId+'" class="btn btn-primary submit">Save changes</button>'+
            '</div>'+
          '</div>'+
        '</div>'+
      '</div>';
      $("#parent_modal").append(newModal);
    }
  };
  /****************Create Multiple Modal********************/


  /****************Populate Dropdown list for nature of group********************/
  //This function is to enforce focus on the currecnt modal.
  $.fn.modal.Constructor.prototype.enforceFocus = function () {
    //Here the select2 has been initiated
    $('select[id^=group_nature_]').select2({
      placeholder: 'Enter Group Nature',
      width: '100%',
      allowClear: true,
      ajax: {
          headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: '/coagrouplist',
          type:'post',
          dataType: 'json',
          delay:250,
          data: function(params){
            return{
              searchTerm: params.term,
            };
          },
          processResults : function(response){
          return{
            results: response
          };
        },
        cache: false,
      }
    });
  };
  /****************Populate Dropdown list for nature of group********************/

  /****************Convert textarea value to arrary********************/
  function conv_textarea_array(data){
    var texts = [];
    for (var i=0; i < data.length; i++) {
      // only push this line if it contains a non whitespace character.
      if (/\S/.test(data[i])) {
        texts.push($.trim(data[i]));
      }
    }

    return texts;
  }
  /****************Convert textarea value to arrary********************/


  /****************Create new group form submission********************/
    $('body').on('click', 'button', function(e) {
      var submitId = e.target.id
      var layerIdArray = e.target.id.split("_");
      var layerId = parseInt(this.id.split("_")[3]);
      if(submitId.match(/group_data_submit_/gi)){

        var form_id = 'form#form_'+ layerId;

        var name = $(form_id +' input[name="group_name"]').val();
        var alias = conv_textarea_array($(form_id +' textarea[name="group_alias"]').val().split(/\n/));
        // var group_nature = $(form_id +' input[name="group_nature"]').val();
        var group_nature = $('#group_nature_'+layerId).val();
        var is_subleger = $(form_id +' input[name="is_subleger"]').val();
        var balance_reporting = $(form_id +' input[name="balance_reporting"]').val();
        var is_calculation = $(form_id +' input[name="is_calculation"]').val();
        var group_status = $('#group_status_'+layerId).val();

        console.log(group_status);

        $.ajax({
          headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: '/coagroup',
          type: "post",
          data: {
                  name: name,
                  alias: alias,
                  group_nature: group_nature,
                  group_behaves_sub_ledger: is_subleger,
                  nett_debit_credit_balance: balance_reporting,
                  use_calculation_taxes_discount: is_calculation,
                  group_status: group_status,
               },
          success: function(response) {
              alert(response['response']);
          }
        });

        $('#form_'+ layerId).trigger("reset");
        // $('#myModalBody_'+layerId).modal('hide');

      }
      else if(submitId.match(/group_data_submit_/gi)){
        $('#form_'+ layerId).trigger("reset");        
      }
    });
  /****************Create new group form submission********************/


