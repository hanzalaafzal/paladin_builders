
  async function getVideoData(date,videotoken){
    $.ajax({
      url: $('#parseURL2').val(),
      async:false,
      data: {
        'token':videotoken
      },
      type:'get',
      dataType:'json',
      success:function(data,status){
        $('#divImage').css('background-image',"url(../"+data[0].video_thumb+")");
        $('#divImage').css('background-repeat',"no-repeat");
        $('#divImage').css('background-size',"cover");
        $('#durationSecs').html(data[0].video_duration+' secs');
        $('#valueDuration').val(data[0].video_duration);
        $('#selectedDate').html('Selected Date: '+date.format("YYYY/MM/DD"));
        $('#videoTitle').html('Title: '+data[0].video_title);
        $('#loops').val('');
        $('#creditCost').val('');
        $('#videoToken').val(videotoken);
        $('#dateTime').val(date.format("YYYY-MM-DD"))
      }
    });
  }


  function getSlots(){
    var loops = $('#loops').val();
    var duration = $('#valueDuration').val();
    var total=parseInt(loops) * parseInt(duration);
    $.ajax({
      url: $('#durationURL').val(),
      async:false,
      data: {
        'date':$('#dateTime').val(),
      },
      type:'get',
      dataType:'json',
      beforeSend:function(){
        $('#selectOption').html('');
        $('#noneDiv').addClass('d-none');
      },
      success:function(data,status){
        $('#selectOption').append(`<select id="optionTime" class="form-control" required name="timeSlot">
        <option disabled selected>Select Time Slot</option>
        `);
        data.forEach(function(item){
          if(item.seconds>total){
            $('#optionTime').append(`<option value="`+item.timeFrame+`">`+item.timeFrame+` | Start time: `+item.start_time+`</option>`)
          }else{
            $('#optionTime').append(`<option disabled value="`+item.timeFrame+`">`+item.timeFrame+` (Taken)</option>`)
          }
        });
        $('#noneDiv').removeClass('d-none');
        $('#creditCost').val((loops*duration).toString()+' Credits');
      }
    });
  }

  function getDateNotifications(date){
    $.ajax({
      url: $('#dateNotiURL').val(),
      async:false,
      data: {
        'date':date.format("YYYY-MM-DD"),
      },
      type:'get',
      dataType:'json',
      beforeSend:function(){
        $('#noti_details').html('');
      },
      success:function(data,status){
        console.log(data);
        data.forEach(function(item){
          $('#noti_details').append(`<div class="row">
                                          <div class="col-md-1">
                                            <input type="checkbox" name="selected[]" class="form-control" value="`+item.noti_id+`" id="selected">
                                          </div>
                                          <div class="col-md-11">
                                            <h6>Title: `+item.video_title+`</h6>
                                            `);

            if(typeof item.first_name == 'undefined'){

            }else{
              $('#noti_details').append(`
                <div class="row">
                  <div class="col-md-1">
                  </div>
                  <div class="col-md-11">
                  By: `+item.first_name+` `+item.last_name+`
                  </div>
                </div>
                `);
            }


          $('#noti_details').append(`</div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-1">
                                          </div>
                                          <div class="col-md-5">
                                            <small>Start Time: `+item.start_time+`</small>
                                          </div>
                                          <div class="col-md-5">
                                            <small>End Time: `+item.end_time+`</small>
                                          </div>
                                        </div>
                                        <br>
                                        `);
        });
        $('#my-event').modal();
      }
    });
  }
