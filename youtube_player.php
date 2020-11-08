<script src="https://www.youtube.com/iframe_api"></script>
<script>
    var players = [];
    function onYouTubeIframeAPIReady() {
        players.forEach(p => {
            var done = false;
            window[`${p.id}_player`] = new YT.Player(p.id, {
            height: p.height,
            width: p.width,
            videoId: p.videoId,
            events: {
                onReady (event) {
                    console.log('onReady', event);
                    p.onReady && p.onReady(event);
                },
                onStateChange (event) {
                    console.log('onStateChange', event);
                    p.onStateChange && p.onStateChange(event);
                },
            }
            });
        });
    }
    function playVideo(id) {
        players.forEach(p => {
            window.document.getElementById(p.id).style.display = 'none';
            window.document.getElementById(p.tv).style.display = 'none';
            window[`${p.id}_player`].stopVideo();
        });
        window[`${id}_player`].playVideo();
        window.document.getElementById(id).style.display = 'block';
    }
    function stopTv(tv) {
        players.forEach(p => {
            window.document.getElementById(p.id).style.display = 'none';
            window[`${p.id}_player`].stopVideo();
        });
        window.document.getElementById(tv).style.display = 'block';
    }
</script>
<?php
function youtube($id, $width, $height, $videoId, $tv) {
    ?>
<div id="<?=$id?>" class="youtube-player" style="display:none;"></div>
<script>
    players.push({
        id: <?= json_encode($id) ?>,
        height: <?= json_encode($height) ?>,
        width: <?= json_encode($width) ?>,
        videoId: <?= json_encode($videoId) ?>,
        tv: <?= json_encode($tv) ?>,
    });
</script>
    <?php
}
