@extends("layouts.app")
@section("css")
<link rel="stylesheet" href="{{asset('css/legal.css')}}">
<link rel="stylesheet" href="{{asset('css/participation.css')}}">
@endsection
@section("content")
<div class="container">
    <h1>Participer à La Nuit MMI</h1>
    <div id="general">
        <h2>Conditions générales</h2>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe, ad officia? Ipsam cumque quis molestias saepe! Blanditiis obcaecati, velit nesciunt porro sapiente odit veniam neque nostrum omnis saepe! Libero suscipit pariatur voluptas itaque nulla deserunt ad at, mollitia odio cum.</p>
        <p>Aut illo quos molestiae sapiente sunt sed natus consectetur. Non consectetur necessitatibus recusandae ad debitis voluptas sequi provident et magnam itaque alias enim hic cumque esse facilis natus, repellendus nemo voluptates, similique totam neque amet ea. Error, dignissimos. Voluptas, doloremque!</p>
    </div>
    <fieldset id="audiovisuel">
        <legend>Audiovisuel</legend>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam ipsum obcaecati eveniet cupiditate corporis fuga itaque fugiat, eius pariatur officiis soluta impedit quas officia rem veritatis cumque ex consequatur modi maxime suscipit? Recusandae quae quasi, in distinctio saepe ducimus placeat, tempore magni enim minima commodi repudiandae molestiae culpa, nostrum dolor.</p>
        <p>Et perspiciatis, aspernatur culpa aliquam nulla in, maxime itaque fuga iste blanditiis nihil repellendus sit minus doloribus optio ducimus quasi consequatur dicta explicabo, laboriosam voluptatibus nam nemo enim? Incidunt nobis ullam culpa nihil corrupti nostrum possimus, officia dignissimos quis omnis ea enim harum, temporibus eos iusto porro perferendis cumque voluptatem.</p>
    </fieldset>
    <fieldset id="communication">
        <legend>Campagne de communication</legend>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam ipsum obcaecati eveniet cupiditate corporis fuga itaque fugiat, eius pariatur officiis soluta impedit quas officia rem veritatis cumque ex consequatur modi maxime suscipit? Recusandae quae quasi, in distinctio saepe ducimus placeat, tempore magni enim minima commodi repudiandae molestiae culpa, nostrum dolor.</p>
        <p>Et perspiciatis, aspernatur culpa aliquam nulla in, maxime itaque fuga iste blanditiis nihil repellendus sit minus doloribus optio ducimus quasi consequatur dicta explicabo, laboriosam voluptatibus nam nemo enim? Incidunt nobis ullam culpa nihil corrupti nostrum possimus, officia dignissimos quis omnis ea enim harum, temporibus eos iusto porro perferendis cumque voluptatem.</p>
    </fieldset>
    <fieldset id="graphique">
        <legend>Production Graphique</legend>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam ipsum obcaecati eveniet cupiditate corporis fuga itaque fugiat, eius pariatur officiis soluta impedit quas officia rem veritatis cumque ex consequatur modi maxime suscipit? Recusandae quae quasi, in distinctio saepe ducimus placeat, tempore magni enim minima commodi repudiandae molestiae culpa, nostrum dolor.</p>
        <p>Et perspiciatis, aspernatur culpa aliquam nulla in, maxime itaque fuga iste blanditiis nihil repellendus sit minus doloribus optio ducimus quasi consequatur dicta explicabo, laboriosam voluptatibus nam nemo enim? Incidunt nobis ullam culpa nihil corrupti nostrum possimus, officia dignissimos quis omnis ea enim harum, temporibus eos iusto porro perferendis cumque voluptatem.</p>
    </fieldset>
    <fieldset id="web">
        <legend>Site web</legend>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam ipsum obcaecati eveniet cupiditate corporis fuga itaque fugiat, eius pariatur officiis soluta impedit quas officia rem veritatis cumque ex consequatur modi maxime suscipit? Recusandae quae quasi, in distinctio saepe ducimus placeat, tempore magni enim minima commodi repudiandae molestiae culpa, nostrum dolor.</p>
        <p>Et perspiciatis, aspernatur culpa aliquam nulla in, maxime itaque fuga iste blanditiis nihil repellendus sit minus doloribus optio ducimus quasi consequatur dicta explicabo, laboriosam voluptatibus nam nemo enim? Incidunt nobis ullam culpa nihil corrupti nostrum possimus, officia dignissimos quis omnis ea enim harum, temporibus eos iusto porro perferendis cumque voluptatem.</p>
    </fieldset>
    <form action="{{route('participateRead')}}" method="post">
        @csrf
        <div>
            <input type="checkbox" name="read" id="read" value="true" required <?php if(Cookie::has("participate")){ echo "checked";}?>>
            <label for="read">J'ai lu et accepté les modalités de participation.</label>
        </div>
        <button type="submit">participer</button>
    </form>


</div>
@endsection