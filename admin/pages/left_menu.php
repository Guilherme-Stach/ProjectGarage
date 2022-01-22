<div class="site-menubar">
      <div class="site-menubar-body">
        <div>
          <div>
            <ul class="site-menu" data-plugin="menu">
              <li class="site-menu-category"></li>
                <li     <?php if($_CURRENT_PAGE=="dashboard"){echo 'class="site-menu-item active"';}else{ echo 'class="site-menu-item"'; }    ?> >
                    <a class="animsition-link" href="index.php">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                    </a>
                </li>
                <li <?php if($_CURRENT_PAGE=="users"){echo 'class="site-menu-item active"';}else{ echo 'class="site-menu-item"'; }    ?> >
                
                    <a class="animsition-link" href="users.php">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Users</span>
                    </a>
                </li>
                <li <?php if($_CURRENT_PAGE=="mechanics"){echo 'class="site-menu-item active"';}else{ echo 'class="site-menu-item"'; }    ?> >
                
                    <a class="animsition-link" href="mechanics.php">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Mechanics</span>
                    </a>
                </li>
                <li <?php if($_CURRENT_PAGE=="bookings"){echo 'class="site-menu-item active"';}else{ echo 'class="site-menu-item"'; }    ?> >
                
                    <a class="animsition-link" href="bookings.php">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Bookings</span>
                    </a>
                </li>
              
              
            </ul>
                
        </div>
        </div>
      </div>
    
      </div> 
      
      <div class="site-gridmenu">
      <div>
        <div>
          <ul>
            <li>
              <a href="apps/mailbox/mailbox.html">
                <i class="icon md-email"></i>
                <span>Mailbox</span>
              </a>
            </li>
            <li>
              <a href="apps/calendar/calendar.html">
                <i class="icon md-calendar"></i>
                <span>Calendar</span>
              </a>
            </li>
            <li>
              <a href="apps/contacts/contacts.html">
                <i class="icon md-account"></i>
                <span>Contacts</span>
              </a>
            </li>
            <li>
              <a href="apps/media/overview.html">
                <i class="icon md-videocam"></i>
                <span>Media</span>
              </a>
            </li>
            <li>
              <a href="apps/documents/categories.html">
                <i class="icon md-receipt"></i>
                <span>Documents</span>
              </a>
            </li>
            <li>
              <a href="apps/projects/projects.html">
                <i class="icon md-image"></i>
                <span>Project</span>
              </a>
            </li>
            <li>
              <a href="apps/forum/forum.html">
                <i class="icon md-comments"></i>
                <span>Forum</span>
              </a>
            </li>
            <li>
              <a href="index.html">
                <i class="icon md-view-dashboard"></i>
                <span>Dashboard</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>