<div class="modal fade" id="notifications" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">通知</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul>    
            @foreach ($notifications as $notification)
                <li class="read_notification" data-id="{{$notification->id}}">{{ $notification->data['msg'] }}
                  <span class ="read">
                    @if($notification->read_at)
                      (已讀)
                    @endif
                  </span>
                </li>
            @endforeach
            </ul>
        </div>
        
      </div>
    </div>
  </div>
  <script>
    $('.read_notification').on('click',function(){
      var $this=$(this)
      $.ajax({
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
        method:'POST',
        url:'read_notification',
        data:{id:$this.data('id')}
      })
      .done(function(msg){
        if(msg.result){
          $this.find('.read').text('(已讀)')
        }
      })  
    })
  </script>