$.noConflict();
 var vid1 = videojs('example-2');

    vid1.ads();
    vid1.vast({
      url: 'http://ad3.liverail.com/?LR_PUBLISHER_ID=1331&LR_CAMPAIGN_ID=229&LR_SCHEMA=vast2'
    });
