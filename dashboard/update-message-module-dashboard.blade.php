@if (global_setting()->system_update == 1 &&  in_array('admin', user_roles()))

    @php
        $universal = \Nwidart\Modules\Facades\Module::find('UniversalBundle');
        $plugins = \Froiden\Envato\Functions\EnvatoUpdate::plugins();
        $versionArray = [];

      foreach ($plugins as $value) {
           $versionArray[$value['envato_id']] = $value['version'];
      }

      $version = $versionArray;
    @endphp

    @if ($universal && config(strtolower($universal) . '.envato_item_id'))
      @if ($version[config(strtolower($universal) . '.envato_item_id')] > File::get($universal->getPath() . '/version.txt') && (config(strtolower($universal) . '.setting')::first()?->notify_update))
        
      @endif
    @else

        @php
            $allModules = \Nwidart\Modules\Facades\Module::allEnabled();

        @endphp
        @foreach($allModules as $key=>$module)

            @if (config(strtolower($module) . '.envato_item_id') && $version[config(strtolower($module) . '.envato_item_id')] > File::get($module->getPath() . '/version.txt') && (config(strtolower($module) . '.setting')::first()?->notify_update))

                
            @endif

        @endforeach
    @endif
@endif
