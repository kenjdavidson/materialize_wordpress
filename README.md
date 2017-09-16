# materialize_wordpress

If your main theme is based off the Materialize framework (http://www.materializecss.com) chances are you'd like to be able to include the components in your posts or pages.  The Materialize Wordpress plugin provides short codes for a subset of the CSS and Components.

## Installation

To install the plugin:

1) Download and Unzip the materialize_wordpress plugin to your Wordpress/wp_content/plugins/ folder
2) Activate the Plugin from the admin panel

## Usage

To use the plugin, there are a number of shortcodes currently available.  When supplying details to each shortcode, the "classes" attribute can include any other MaterializeCSS rules available.

### Grid

The CSS Grid is available, configure it use the following:

```
[mdw-row
  container=[true|false]
  classes="list of extra-classes"
]
  [mdw-col
    sizes="s12 m6 l6"]Column 1[/mdw-col]
  [mdw-col
    sizes="s12 m6 l6"]Column 2[/mdw-col]    
[/mdw-row]
```

### Carousel

The Carousel component is available for display.  When working with the Carousels you can provide: the ID attribute, which will be passed to <div>; the slider attribute, which will add the carousel-slider class to the <div>.  Carousel-item elements can be added in a number of ways:

#### Blocks

```
[mdw-carousel
  id="mycarousel"
  slider=[true | false]
  classes="list of extra-classes"    
]
  [mdw-carousel-item]  <h4>Item 1</h4>
    <p>This is something for item 1</p>[/mdw-carousel-item]
  [mdw-carousel-item]  <h4>Item 1</h4>
    <p>This is something for item 1</p>[/mdw-carousel-item]
    
[/mdw-carousel]
```

#### Media

```
[mdw-carousel
  id="mycarousel"
  slider=[true | false]
  classes="list of extra-classes"    
]
  [gallery sizes="[thumbnail|full" ids="###,###,###,###"]
[/mdw-carousel]
```

#### Galleries
```
[mdw-carousel
  id="mycarousel"
  slider=[true | false]
  classes="list of extra-classes"    
]
  [mdw-carousel-item]<img src=""/>[/mdw-carousel-item]
  [mdw-carousel-item]<img src=""/>[/mdw-carousel-item]
    
[/mdw-carousel]
```

### Collapsible

TODO
