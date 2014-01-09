      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">Abaka Admin Panel</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
			<li class="active">
				<a href="#" style="text-align:center">
					<img src="http://www.gravatar.com/avatar/<?=md5(mb_strtolower(trim($i_user['email'])));?>?s=40" alt="" height="40px" width="40px" class="center-block" />
				</a>
			</li>
			<li>&nbsp;</li>
			<li><a href="/"><span class="icon-forward"></span> View Site</a></li>
			<li>&nbsp;</li>
			<li><a href="/"><span class="icon-meter"></span> Dashboard</a></li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-film"></span> Videos <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/series"><span class="icon-tv"></span> Series</a></li>
                <li><a href="/episodes"><span class="icon-drawer-2"></span> Episodes</a></li>
                <li><a href="/mirrors"><span class="icon-play"></span> Mirrors</a></li>
                <li><a href="/genres"><span class="icon-tags"></span> Genres</a></li>
                <li><a href="/series_types"><span class="icon-tags"></span> Series Types</a></li>
                <li><a href="/reports"><span class="icon-flag"></span> Reports</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-accessibility"></span> Users & Access <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/users"><span class="icon-users"></span> Users</a></li>
                <li><a href="/user_groups"><span class="icon-user-4"></span> Groups</a></li>
                <li><a href="/access"><span class="icon-shield"></span> Permissions</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-map"></span> Articles <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/pages"><span class="icon-file"></span> Pages</a></li>
                <li><a href="/articles"><span class="icon-newspaper"></span> Articles</a></li>
                <li><a href="/article_categories"><span class="icon-bookmark"></span> Article Categories</a></li>
                <li><a href="/newscomments"><span class="icon-bubbles-2"></span> Article Comments</a></li>
              </ul>
            </li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-hammer"></span> Tools <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/dbtools"><span class="icon-cabinet"></span> Database</a></li>
              </ul>
            </li>
			<li><a href="/statistics"><span class="icon-chart"></span> Statistics</a></li>
			<li><a href="/logs"><span class="icon-console"></span> Logs</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$i_user['username'];?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="/logout"><span class="icon-switch"></span> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>