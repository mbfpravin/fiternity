 <div id="test-popup" class="white-popup mfp-with-anim mfp-hide search-overlay">
    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url().'/'; ?>">
        <div class="row feed-options-bar">
            <div class="col-2 topics">
                <p>Site Search:</p>
            </div>
            <div class="col-10 search-input">
                <input type="text" id="tags" name="s" class="search-text" placeholder="" />
                <button title="Close (Esc)" type="button" class="close has-ripple">×</button>
            </div>
            <div class="tag-search no-padding disabled">
                <a href="javascript:void(0);" class="button">SEARCH</a>
            </div>
        </div>
    </form>
</div>