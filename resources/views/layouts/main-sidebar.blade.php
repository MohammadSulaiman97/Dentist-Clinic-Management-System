<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						@if (Auth::check())

							<div class="user-info">
								<h4 class="font-weight-semibold mt-3 mb-0">{{Auth()->user()->name}}</h4>
								<span class="mb-0 text-muted">{{Auth()->user()->email}}</span>
							</div>

						@endif

					</div>
				</div>
				<ul class="side-menu mt-4">
					<li class="side-item side-item-category" style="font-size: medium">القائمة الرئيسية</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='home') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">الرئيسية</span></a>
					</li>


						<li class="side-item side-item-category" style="font-size: medium">الفواتير</li>

							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">معلومات الفواتير</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">
										<li><a class="slide-item" href="{{ url('/' . $page='invoices') }}">قائمة الفواتير</a></li>

										<li><a class="slide-item" href="{{ url('/' . $page='Invoice_Paid') }}">الفواتير المدفوعة</a></li>

										<li><a class="slide-item" href="{{ url('/' . $page='Invoice_Partial') }}">الفواتير المدفوعة جزئيا</a></li>

										<li><a class="slide-item" href="{{ url('/' . $page='Invoice_UnPaid') }}">الفواتير الغير مدفوعة</a></li>

								</ul>
							</li>


						<li class="side-item side-item-category" style="font-size: medium">التقارير</li>

							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"/><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg><span class="side-menu__label">معلومات التقارير</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">

										<li><a class="slide-item" href="{{ url('/' . $page='invoices_report') }}">تقارير الفواتير</a></li>

										<li><a class="slide-item" href="{{ url('/' . $page='patients_report') }}">تقارير المرضى</a></li>

								</ul>
							</li>

						<li class="side-item side-item-category" style="font-size: medium">المرضى</li>

							<li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg><span class="side-menu__label">معلومات المرضى</span><i class="angle fe fe-chevron-down"></i></a>
								<ul class="slide-menu">

										<li><a class="slide-item" href="{{ url('/' . $page='patient') }}">قائمة المرضى</a></li>

										<li><a class="slide-item" href="{{ url('/' . $page='DentistAppointments') }}">قائمة المواعيد</a></li>

								    	<li><a class="slide-item" href="{{ url('/' . $page='Archive') }}">قائمة المواعيد المنتهية</a></li>

								</ul>
							</li>


				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
