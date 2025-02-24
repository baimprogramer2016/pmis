  <!-- Sidebar -->
  <div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="#" class="logo">
          <img
            src="{{asset('assets/img/logo-light.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            height="40"
          />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          
          @can('view_dashboard')
          <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
              <i class="fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @endcan
          <li class="nav-item {{ Request::is('gantt-chart*') ? 'active' : '' }}">
            <a href="#">
             
              <p>Menu</p>
            </a>
          </li>
          
          @can('view_letter')
          <li class="nav-item {{ Request::is('surat*') ? 'active' : '' }}">
            <a href="{{ route('surat') }}">
              <i class="fas fa-pen-square"></i>
              <p>Letter</p>
            </a>
          </li>
          @endcan
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#schedule">
              <i class="fas fa-calendar-alt"></i>
              <p>Schedule Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('schedule-management*') || Request::is('s-curve*') ? 'show' : '' }}"" id="schedule">
              <ul class="nav nav-collapse">
                @can('view_doc_schedule')
                <li class="{{ Request::is('schedule-management') ? 'active' : '' }}">
                  <a href="{{ route('schedule-management') }}">
                    <span class="sub-item">Schedule</span>
                    <span class="badge badge-success">{{ $jml_schedule}}</span>
                  </a>
                </li>
                @endcan
                @can('view_input_s_curve')
                <li class="{{ Request::is('s-curve') ? 'active' : '' }}">
                  <a href="{{ route('s-curve') }}">
                    <span class="sub-item">Input S-Curve</span>
                    <span class="badge badge-success">{{ $jml_scurve}}</span>
                  </a>
                </li>
                @endcan
                @can('view_s_curve')
                <li class="{{ Request::is('s-curve-chart') ? 'active' : '' }}">
                  <a href="{{ route('s-curve-chart') }}">
                    <span class="sub-item">S-Curve</span>
                  </a>
                </li>          
                @endcan     
                @can('view_progress')
                <li class="{{ Request::is('s-curve-bar') ? 'active' : '' }}">
                  <a href="{{ route('s-curve-bar') }}">
                    <span class="sub-item">Progress</span>
                  </a>
                </li>  
                @endcan
              </ul>
            </div>
          </li>
          {{-- <li class="nav-item {{ Request::is('master-schedule*') ? 'active' : '' }}">
            <a href="{{ route('master-schedule') }}">
              <i class="fas fa-calendar-alt"></i>
              <p>Schedule Management</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('gantt-chart*') ? 'active' : '' }}">
            <a href="{{ route('gantt-chart') }}">
              <i class="fas fa-car-side"></i>
              <p>Task Progress</p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="#">
             
              <p>Document Management</p>
            </a>
          </li>
          @can('view_sop')
          <li class="nav-item {{ Request::is('sop*') ? 'active' : '' }}">
            <a href="{{ route('sop') }}">
              <i class="fas fa-pen-square"></i>
              <p>Project Procedure</p>
              <span class="badge badge-success">{{ $jml_sop}}</span>
            </a>
          </li>
          @endcan
          
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#engineering">
              <i class="fas fa-tachometer-alt"></i>

              <p>Engineering</p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('document-engineer*') || Request::is('document-engineer')  ? 'show' : '' }}"" id="engineering">
              <ul class="nav nav-collapse">
                @can('view_doc_engineering_upload')
                <li class="{{ Request::is('document-engineer-tambah') ? 'active' : '' }}">
                  <a href="{{ route('document-engineer-tambah') }}">
                    <span class="sub-item">Upload Document</span>
                  </a>
                </li>
                @endcan
                @can('view_doc_engineering_check')
                <li class="{{ Request::is('document-engineer-check') ? 'active' : '' }}">
                  <a href="{{ route('document-engineer-check') }}">
                    <span class="sub-item">Check</span>
                  </a>
                </li>
                @endcan
                @can('view_doc_engineering_review')
                <li class="{{ Request::is('document-engineer-review') ? 'active' : '' }}">
                  <a href="{{ route('document-engineer-review') }}">
                    <span class="sub-item">Review</span>
                  </a>
                </li>
                @endcan
                @can('view_doc_engineering_approve')
                <li class="{{ Request::is('document-engineer-approve') ? 'active' : '' }}">
                  <a href="{{ route('document-engineer-approve') }}">
                    <span class="sub-item">Approve</span>
                  </a>
                </li>
                @endcan
                @can('view_doc_engineering_mdr')
                <li class="{{ Request::is('document-engineer-master-deliverables-register') ? 'active' : '' }}">
                  <a href="{{ route('document-engineer-master-deliverables-register') }}">
                    <span class="sub-item">MDR</span>
                    <span class="badge badge-success">{{ $jml_mdr}}</span>
                  </a>
                </li>
                @endcan
                @can('view_doc_engineering_basic_design')
                <li class="{{ Request::is('document-engineer-basic-design') ? 'active' : '' }}">
                  <a href="{{ route('document-engineer-basic-design') }}">
                    <span class="sub-item">Basic Design</span>
                    <span class="badge badge-success">{{ $jml_bd}}</span>
                  </a>
                </li>   
                @endcan
                @can('view_doc_engineering_ded')
                <li class="{{ Request::is('document-engineer-detail-engineering-design') ? 'active' : '' }}">
                  <a href="{{ route('document-engineer-detail-engineering-design') }}">
                    <span class="sub-item">DED</span>
                    <span class="badge badge-success">{{ $jml_ded}}</span>
                  </a>
                </li>     
                @endcan              
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#constructiondocument">
              <i class="fas fa-hotel"></i>

              <p>Construction</p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('construction-document*') || Request::is('construction-document') ? 'show' : '' }}"" id="constructiondocument">
              <ul class="nav nav-collapse">
                @can('view_construction_upload')
                <li class="{{ Request::is('construction-document-tambah') ? 'active' : '' }}">
                  <a href="{{ route('construction-document-tambah') }}">
                    <span class="sub-item">Upload Document</span>
                  </a>
                </li>
                @endcan
                @can('view_construction_check')
                <li class="{{ Request::is('construction-document-check') ? 'active' : '' }}">
                  <a href="{{ route('construction-document-check') }}">
                    <span class="sub-item">Check</span>
                  </a>
                </li>
                @endcan
                @can('view_construction_review')
                <li class="{{ Request::is('construction-document-review') ? 'active' : '' }}">
                  <a href="{{ route('construction-document-review') }}">
                    <span class="sub-item">Review</span>
                  </a>
                </li>
                @endcan
                @can('view_construction_approve')
                <li class="{{ Request::is('construction-document-approve') ? 'active' : '' }}">
                  <a href="{{ route('construction-document-approve') }}">
                    <span class="sub-item">Approve</span>
                  </a>
                </li>
                @endcan
                @can('view_construction_document')
                <li class="{{ Request::is('construction-document') ? 'active' : '' }}">
                  <a href="{{ route('construction-document') }}">
                    <span class="sub-item">Construction Document</span>
                    <span class="badge badge-success">{{ $jml_construction}}</span>
                  </a>
                </li>          
                @endcan    
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#fieldinstruction">
              <i class="fas fa-chess-rook"></i>

              <p>Field Instructions</p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('field-instruction*') || Request::is('field-instruction') ? 'show' : '' }}"" id="fieldinstruction">
              <ul class="nav nav-collapse">
                @can('view_field_instruction_upload')
                <li class="{{ Request::is('field-instruction-tambah') ? 'active' : '' }}">
                  <a href="{{ route('field-instruction-tambah') }}">
                    <span class="sub-item">Upload Document</span>
                  </a>
                </li>
                @endcan
                @can('view_field_instruction_check')
                <li class="{{ Request::is('field-instruction-check') ? 'active' : '' }}">
                  <a href="{{ route('field-instruction-check') }}">
                    <span class="sub-item">Check</span>
                  </a>
                </li>
                @endcan
                @can('view_field_instruction_review')
                <li class="{{ Request::is('field-instruction-review') ? 'active' : '' }}">
                  <a href="{{ route('field-instruction-review') }}">
                    <span class="sub-item">Review</span>
                  </a>
                </li>
                @endcan
                @can('view_field_instruction_approve')
                <li class="{{ Request::is('field-instruction-approve') ? 'active' : '' }}">
                  <a href="{{ route('field-instruction-approve') }}">
                    <span class="sub-item">Approve</span>
                  </a>
                </li>
                @endcan
                @can('view_field_instruction')
                <li class="{{ Request::is('field-instruction') ? 'active' : '' }}">
                  <a href="{{ route('field-instruction') }}">
                    <span class="sub-item">Field Instructions</span>
                    <span class="badge badge-success">{{ $jml_field_construction}}</span>
                  </a>
                </li>
                @endcan
              
                         
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#correspondence">
              <i class="fas fa-folder-open"></i>

              <p>Correspondence </p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('surat-masuk*') || Request::is('surat-keluar*') ? 'show' : '' }}"" id="correspondence">
              <ul class="nav nav-collapse">
                @can('view_correspondence_surat_masuk')
                <li class="{{ Request::is('surat-masuk*') ? 'active' : '' }}">
                  <a href="{{ route('surat-masuk') }}">
                    <span class="sub-item">Surat Masuk</span>
                    <span class="badge badge-success">{{ $jml_cor_masuk}}</span>
                  </a>
                </li>
                @endcan
                @can('view_correspondence_surat_keluar')
                <li class="{{ Request::is('surat-keluar*') ? 'active' : '' }}">
                  <a href="{{ route('surat-keluar') }}">
                    <span class="sub-item">Surat Keluar</span>
                    <span class="badge badge-success">{{ $jml_cor_keluar}}</span>
                  </a>
                </li>   
                @endcan            
              </ul>
            </div>
          </li>
          @can('view_file_manager')
          <li class="nav-item {{ Request::is('file-manager*') ? 'active' : '' }}">
            <a href="{{ route('file-manager') }}">
              <i class="fas fa-folder"></i>
              <p>File Manager</p>
            </a>
          </li>
          @endcan
          <x-custom-document-management />
          <x-custom-photographic />
          <x-custom-drawings />
          <li class="nav-item">
            <a href="#">
              <p>Report</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#report">
              <i class="fas fa-folder"></i>

              <p>Report</p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('report*') || Request::is('rfi*') || Request::is('mvr*') || Request::is('mrr*')  ? 'show' : '' }}"" id="report">
              <ul class="nav nav-collapse">
                @can('view_daily_report')
                <li class="{{ Request::is('report-daily*') ? 'active' : '' }}">
                  <a href="{{ route('report-daily') }}">
                    <span class="sub-item">Daily Report</span>
                    <span class="badge badge-success">{{ $jml_daily_report}}</span>
                  </a>
                </li>
                @endcan
                @can('view_weekly_report')
                <li class="{{ Request::is('report-weekly') ? 'active' : '' }}">
                  <a href="{{ route('report-weekly') }}">
                    <span class="sub-item">Weekly Report</span>
                    <span class="badge badge-success">{{ $jml_weekly_report}}</span>
                  </a>
                </li>  
                @endcan
                @can('view_monthly_report')
                <li class="{{ Request::is('report-monthly*') ? 'active' : '' }}">
                  <a href="{{ route('report-monthly') }}">
                    <span class="sub-item">Monthly Report</span>
                    <span class="badge badge-success">{{ $jml_monthly_report}}</span>
                  </a>
                </li>    
                @endcan
                @can('view_rfi')
                <li class="{{ Request::is('rfi*') ? 'active' : '' }}">
                  <a href="{{ route('rfi') }}">
                    <span class="sub-item">Request for Inspection (RFI)</span>
                    <span class="badge badge-success">{{ $jml_rfi}}</span>
                  </a>
                </li>    
                @endcan
                @can('view_mvr')
                <li class="{{ Request::is('mvr*') ? 'active' : '' }}">
                  <a href="{{ route('mvr') }}">
                    <span class="sub-item">Material Verification Report</span>
                    <span class="badge badge-success">{{ $jml_mvr}}</span>
                  </a>
                </li>    
                @endcan
                @can('view_mrr')
                <li class="{{ Request::is('mrr*') ? 'active' : '' }}">
                  <a href="{{ route('mrr') }}">
                    <span class="sub-item">Material Receiving Report</span>
                    <span class="badge badge-success">{{ $jml_mrr}}</span>
                  </a>
                </li>    
                @endcan
                      
              </ul>
            </div>
          </li>
          @can('view_minutes_of_meeting')
          <li class="nav-item {{ Request::is('mom*') ? 'active' : '' }}">
            <a href="{{ route('mom') }}">
              <i class="fas fa-pen"></i>
              <p>Minutes Of Meeting</p>
              <span class="badge badge-success">{{ $jml_mom}}</span>
            </a>
          </li>
          @endcan
          {{-- @can('view_minutes_of_meeting')
          <li class="nav-item {{ Request::is('custom-report*') ? 'active' : '' }} bg-success ">
            <a href="{{ route('custom-report') }}">
              <i class="fab fa-whmcs" style="color:white"></i>
              <p class="text-white"> Custom Report</p>
            </a>
          </li>
          @endcan --}}
        

          <li class="nav-item {{ Request::is('gantt-chart*') ? 'active' : '' }}">
            <a href="#">
             
              <p>Settings</p>
            </a>
          </li>
          @if(Auth::user()->hasAnyRole(['superadmin']))
          <li class="nav-item {{ Request::is('user*') ? 'active' : '' }}">
            <a href="{{ route('user') }}">
              <i class="fas fa-users"></i>
              <p>Users</p>
            </a>
          </li>
          @endif
          @if(Auth::user()->hasAnyRole(['superadmin']))
          <li class="nav-item {{ Request::is('role*') ? 'active' : '' }}">
            <a href="{{ route('role') }}">
              <i class="fas fa-key"></i>
              <p>Roles</p>
            </a>
          </li>
          @endif
          @if(Auth::user()->hasAnyRole(['superadmin']))
          <li class="nav-item {{ Request::is('permission*') ? 'active' : '' }}">
            <a href="{{ route('permission') }}">
              <i class="fas fa-lock"></i>
              <p>Permissions</p>
            </a>
          </li>
          @endif
          @can('view_custom')
          <li class="nav-item {{ Request::is('master-*') ? 'active' : '' }}">
            <a href="{{ route('master-custom') }}">
              <i class="fab fa-whmcs"></i>
              <p>Custom</p>
            </a>
          </li>
          @endif
      

        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->