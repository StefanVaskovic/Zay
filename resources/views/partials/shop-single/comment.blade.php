{{--@dd($subComments)--}}
{{--@dd($users)--}}
{{--@dd($comment)--}}

<div class="single-comment-item {{--@if(isset($item->user_replied_id)) reply-comment @endif--}}">
    <div class="sc-author">
        <img src="{{$comment->user->image}}" alt="">
    </div>
    <div class="sc-text">
        <span>{{$comment->date}}</span>
        <h5>{{$comment->user->name}}</h5>
        <p>{{$comment->text}}</p>
        <a href="#" class="comment-btn like" data-idcomment="{{$comment->id}}"
           data-iduser="{{$comment->user->id}}" data-form="{{$i}}">Like</a>
        <a href="#" class="comment-btn reply" data-idcomment="{{$comment->id}}"
           data-iduser="{{$comment->user->id}}" data-form="{{$i}}">Reply</a>
        <form class="replyForm" data-idproduct="{{$product->id}}" data-idcomment="{{$comment->id}}"
              data-iduser="{{$comment->user->id}}" data-form="{{$i}}">
            <div class="mb-3">
                <textarea class="form-control mt-1" rows="8"></textarea>
            </div>
            <p class="error text-danger"></p>
            <div class="row">
                <div class="col text-end mt-2">
                    <input  class="btn btn-success btn-lg px-3 send" type="button" value="Send"/>
                </div>
            </div>
        </form>
    </div>
    <p>Likes : {{$comment->likes}}</p>
</div>

@if(count($subComments) != 0)
    @foreach($subComments as $j => $subComment)
   {{-- {{dd($subComment)}}--}}
        <div class="single-comment-item reply-comment">
            <div class="sc-author">
                <img src="{{$subComment->image}}" alt="">
            </div>
            <div class="sc-text">
                <span>{{$subComment->pivot->date}}</span>
                <h5>{{$subComment->name}}</h5>
                @php($repliedUser = "")

                @foreach($users as $u)
                    @if($u->id == $subComment->pivot->user_replied_id)
                       @php( $repliedUser = $u->name)
                    @endif
                @endforeach
                <p><span>@ {{!empty($repliedUser) ? $repliedUser : $subComment->name}}</span> {{$subComment->pivot->text}}</p>
                <a href="#" class="comment-btn like" data-idcomment="{{$subComment->pivot->comment_id}}"
                   data-iduser="{{$subComment->id}}" data-form="{{$j}}">Like</a>
                <a href="#" class="comment-btn reply" data-idcomment="{{$subComment->pivot->comment_id}}"
                   data-iduser="{{$subComment->id}}" data-form="{{$j}}">Reply</a>
                <form class="replyForm" data-idproduct="{{$product->id}}" data-idcomment="{{$subComment->pivot->comment_id}}"
                      data-iduser="{{$subComment->id}}" data-form="{{$j}}">
                    <div class="mb-3">
                        <textarea name="comment" class="form-control mt-1" rows="8"></textarea>
                    </div>
                    <p class="error text-danger"></p>
                    <div class="row">
                        <div class="col text-end mt-2">
                            <input  class="btn btn-success btn-lg px-3 send" type="button" value="Send"/>
                        </div>
                    </div>
                </form>
            </div>
            <p>Likes : {{$subComment->pivot->likes}}</p>
        </div>
    @endforeach
@endif
