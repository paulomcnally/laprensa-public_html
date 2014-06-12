$(function() {
    $('#futboltotal-slideshow').cycle({
        fx: 'scrollHorz',
        timeout: 20000,
        prev: '#futboltotal-prev',
        next: '#futboltotal-next',
        pager: '#futboltotal-pager',
        pagerAnchorBuilder: pagerFactory
    },'pause');
    function pagerFactory(idx, slide) {
        return '#futboltotal-pager li:eq(' + (idx) + ') a';
    };
});
