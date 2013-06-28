ZF2 Skeleton App
================

Installed Modules
* https://github.com/zendframework/ZFTool
* https://github.com/zendframework/ZendDeveloperTools

Modules to consider

* https://github.com/EvanDotPro/EdpModuleLayouts


DO

= service specific loaders

Use the various service configuration methods when you need to define
closures or instance callbacks for factories, abstract factories,
and initializers. This prevents caching problems, and also allows you
to write your configuration files in other markup formats.


= Languages (support multiple languages)
- implement a langauage switcher module.
  - adds language param to all routes.
  - helper url generator plugins for controllers and views.


= Translation strategy
- run script to scan module and
    - add any missing translation keys to the index.
    - remove unused translation keys.
    - provide the option to generate a report that for new keys and existing keys
      (utiity to generate support for other language files).
