<ul id="NhanYTB" ng-app="VoHuuNhan" ng-controller="mainController as main"class="list-film">
                        
        <section style="overflow-y: scroll;list-style: none;overflow: auto;" ng-app="VoHuuNhan" ng-controller="mainController as main">
  <div class="container">
      
      <li id="YTB" class="YoutubeAPI" ng-repeat="vid in main.videoListing">
          <div class="poster">
            <a target="_blank" ng-href="https://www.youtube.com/watch?v={{vid.id.videoId}}">
                <img ng-src={{vid.snippet.thumbnails.medium.url}}>
            </a>
            <div class="Youtube"><i class="fa fa-play" aria-hidden="true"></i></div>
        </div>
        <div class="name">
            <h4>
                <a ng-bind="vid.snippet.title" ng-href="https://www.youtube.com/watch?v={{vid.id.videoId}}" target="_blank"></a>
            </h4>
            <dfn>Anime OP & Music</dfn>
        </div>
     </li>
  </div>
</section>

     
                    </ul>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
    
            <script src='//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js'></script>
 <script src='<?php echo $trangchu ?>/assets/js/youtube.js'></script>