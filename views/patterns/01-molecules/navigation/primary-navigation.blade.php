@if (has_nav_menu('primary_navigation'))
  <nav class="c-primary-nav c-priority-nav" role="navigation">
    @php
      $menu_name = 'primary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
      $primary_nav = wp_get_nav_menu_items( $menu->term_id);
      $count = 0;
      $submenu = false;
    @endphp
    <ul class="c-primary-nav__list c-priority-nav__list">
      @php $primary_nav = json_decode(json_encode($primary_nav), true); @endphp
      @foreach ($primary_nav as $nav)
        @php
          $link_url = $nav['url'];
          $link_text = $nav['title'];
          $link_classes = ($nav['classes'] ? ' ' . implode(' ', $nav['classes']) : '');
          $link_target = ($nav['target'] ? ' target="'. $nav['target'] . '"' : '');
          $link_title = ($nav['attr_title'] ? ' title="'. $nav['attr_title'] . '"' : '');
          $link_description = ($nav['description'] ? ' description="' . $nav['description'] . '"' : '');
          $link_rel = ($nav['xfn'] ? ' rel="'. $nav['xfn'] . '"' : '');
        @endphp
        @if (isset($primary_nav[$count + 1]))
          @php
            $parent = $primary_nav[$count + 1]['menu_item_parent'];
          @endphp
        @endif
        @if (!$nav['menu_item_parent'])
          @php $parent_id = $nav['ID']; @endphp
          <li class="c-primary-nav__list-item has-subnav">
            <a href="{{ $link_url }}" class="c-primary-nav__link u-font--primary-nav u-color--gray--dark u-theme--link-hover--base u-theme--border-color--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{{ $link_text }}</a>
        @endif
        @if ($parent_id == $nav['menu_item_parent'])
          @if (!$submenu)
            @php $submenu = true; @endphp
            <span class="c-subnav__arrow o-arrow--down u-path-fill--gray"></span>
            <ul class="c-primary-nav__subnav c-subnav">
          @endif
            <li class="c-primary-nav__subnav__list-item c-subnav__list-item u-background-color--gray--light">
              <a href="{{ $link_url }}" class="c-primary-nav__subnav__link c-subnav__link u-color--gray--dark u-theme--link-hover--base{{ $link_classes }}"{!! $link_target !!}{!! $link_title !!}{!! $link_description !!}{!! $link_rel !!}>{{ $link_text }}</a>
            </li>
            @if ($parent != $parent_id && $submenu)
              </ul> <!-- /.c-primary-nav__subnav -->
              @php $submenu = false; @endphp
            @endif
        @endif
        @if ($parent != $parent_id)
          </li>
          @php $submenu = false; @endphp
        @endif
        @php $count++; @endphp
      @endforeach
      {!! wp_reset_postdata() !!}
    </ul> <!-- /.c-primary-nav__list -->
  </nav> <!-- /.c-primary-nav -->
@endif