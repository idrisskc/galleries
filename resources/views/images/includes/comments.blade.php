@if($image->comments)

    <script>
        window.Laravel = <?php echo json_encode([
            'csrt_token' => csrf_token(),
            'is_logged' => Auth::check(),
            'user_id' => Auth::id(),
            'author_id' => $user->id,
            'image_id' => $image->id,
        ]); ?>
    </script>

    <comments></comments>

    <script>
        $(document).ready(function() {
            $('.submit_on_enter').keydown(function(event) {
                // enter has keyCode = 13, change it if you want to use another button
                if (event.keyCode == 13) {
                    this.form.submit();
                    return false;
                }
            });
        });
    </script>

@endif