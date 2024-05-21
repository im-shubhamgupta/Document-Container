https://www.jstree.com/api/


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>jsTree test</title>
  <!-- 2 load the theme CSS file -->
  <!-- <link rel="stylesheet" href="../library/js_tree/dist/themes/default/style.min.css" /> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

  <!-- <link href="../library/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="../library/font-awesome.css" rel="stylesheet"> -->

    <!-- <link href="../library/style.min.css" rel="stylesheet"> -->

    <!-- <link href="../library/animate.css" rel="stylesheet"> -->
    <!-- <link href="../library/style.css" rel="stylesheet"> -->
</head>
<body>


<div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Basic example <small>with custom Font Awesome icons.</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div id="jstree1">
                        <ul>
                            <li class="jstree-open">Admin theme
                                <ul>
                                    <li>css
                                        <ul>
                                            <li data-jstree='"type":"css"}'>animate.css</li>
                                            <li data-jstree='"type":"css"}'>bootstrap.css</li>
                                            <li data-jstree='"type":"css"}'>style.css</li>
                                        </ul>
                                    </li>
                                    <li>email-templates
                                        <ul>
                                            <li data-jstree='"type":"html"}'>action.html</li>
                                            <li data-jstree='"type":"html"}'>alert.html</li>
                                            <li data-jstree='"type":"html"}'>billing.html</li>
                                        </ul>
                                    </li>
                                    <li>fonts
                                        <ul>
                                            <li data-jstree='"type":"svg"}'>glyphicons-halflings-regular.eot</li>
                                            <li data-jstree='"type":"svg"}'>glyphicons-halflings-regular.svg</li>
                                            <li data-jstree='"type":"svg"}'>glyphicons-halflings-regular.ttf</li>
                                            <li data-jstree='"type":"svg"}'>glyphicons-halflings-regular.woff</li>
                                        </ul>
                                    </li>
                                    <li class="jstree-open">img
                                        <ul>
                                            <li data-jstree='"type":"img"}'>profile_small.jpg</li>
                                            <li data-jstree='"type":"img"}'>angular_logo.png</li>
                                            <li class="text-navy" data-jstree='"type":"img"}'>html_logo.png</li>
                                            <li class="text-navy" data-jstree='"type":"img"}'>mvc_logo.png</li>
                                        </ul>
                                    </li>
                                    <li class="jstree-open">js
                                        <ul>
                                            <li >inspinia.js</li>
                                            <li data-jstree='"type":"js"}'>bootstrap.js</li>
                                            <li data-jstree='"type":"js"}'>jquery-2.1.1.js</li>
                                            <li data-jstree='"type":"js"}'>jquery-ui.custom.min.js</li>
                                            <li  class="text-navy" data-jstree='"type":"js"}'>jquery-ui-1.10.4.min.js</li>
                                        </ul>
                                    </li>
                                    <li data-jstree='"type":"html"}'> affix.html</li>
                                    <li data-jstree='"type":"html"}'> dashboard.html</li>
                                    <li data-jstree='"type":"html"}'> buttons.html</li>
                                    <li data-jstree='"type":"html"}'> calendar.html</li>
                                    <li data-jstree='"type":"html"}'> contacts.html</li>
                                    <li data-jstree='"type":"html"}'> css_animation.html</li>
                                    <li  class="text-navy" data-jstree='"type":"html"}'> flot_chart.html</li>
                                    <li  class="text-navy" data-jstree='"type":"html"}'> google_maps.html</li>
                                    <li data-jstree='"type":"html"}'> icons.html</li>
                                    <li data-jstree='"type":"html"}'> invoice.html</li>
                                    <li data-jstree='"type":"html"}'> login.html</li>
                                    <li data-jstree='"type":"html"}'> mailbox.html</li>
                                    <li data-jstree='"type":"html"}'> profile.html</li>
                                    <li  class="text-navy" data-jstree='"type":"html"}'> register.html</li>
                                    <li data-jstree='"type":"html"}'> timeline.html</li>
                                    <li data-jstree='"type":"html"}'> video.html</li>
                                    <li data-jstree='"type":"html"}'> widgets.html</li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="ibox-content">

                    <div id="using_json"></div>

                </div>


  <!-- 3 setup a container element -->
  <div id="jstree22">
    <!-- in this example the tree is populated from inline HTML -->
    <ul>
      <li>Root node 1
        <ul>
          <li id="child_node_1">Child node 1</li>
          <li>Child node 2</li>
        </ul>
      </li>
      <li>Root node 2</li>
    </ul>
  </div>
  <button>demo button</button>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

<script>
    $(document).ready(function(){

        $('#jstree1').jstree({
            'core' : {
                'check_callback' : true
            },
            'plugins' : [ 'types', 'dnd' ],
            'types' : {
                'default' : {
                    'icon' : 'fa fa-folder'
                },
                'html' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'svg' : {
                    'icon' : 'fa fa-file-picture-o'
                },
                'css' : {
                    'icon' : 'fa fa-file-code-o'
                },
                'img' : {
                    'icon' : 'fa fa-file-image-o'
                },
                'js' : {
                    'icon' : 'fa fa-file-text-o'
                }

            }
        });

        $('#using_json').jstree({
            'core' : {
            'data' : [
                'Empty Folder',
                {
                    'text': 'Resources',
                    'state': {
                        'opened': true
                    },
                    'children': [
                        {
                            'text': 'css',
                            'children': [
                                {
                                    'text': 'animate.css', 'icon': 'none'
                                },
                                {
                                    'text': 'bootstrap.css', 'icon': 'none'
                                },
                                {
                                    'text': 'main.css', 'icon': 'none'
                                },
                                {
                                    'text': 'style.css', 'icon': 'none'
                                }
                            ],
                            'state': {
                                'opened': true
                            }
                        },
                        {
                            'text': 'js',
                            'children': [
                                {
                                    'text': 'bootstrap.js', 'icon': 'none'
                                },
                                {
                                    'text': 'inspinia.min.js', 'icon': 'none'
                                },
                                {
                                    'text': 'jquery.min.js', 'icon': 'none'
                                },
                                {
                                    'text': 'jsTree.min.js', 'icon': 'none'
                                },
                                {
                                    'text': 'custom.min.js', 'icon': 'none'
                                }
                            ],
                            'state': {
                                'opened': true
                            }
                        },
                        {
                            'text': 'html',
                            'children': [
                                {
                                    'text': 'layout.html', 'icon': 'none'
                                },
                                {
                                    'text': 'navigation.html', 'icon': 'none'
                                },
                                {
                                    'text': 'navbar.html', 'icon': 'none'
                                },
                                {
                                    'text': 'footer.html', 'icon': 'none'
                                },
                                {
                                    'text': 'sidebar.html', 'icon': 'none'
                                }
                            ],
                            'state': {
                                'opened': true
                            }
                        }
                    ]
                },
                'Fonts',
                'Images',
                'Scripts',
                'Templates',
            ]
        } });
    });

  $(function () { $('#jstree_demo_div').jstree(); });

  $('#jstree_demo_div').on("changed.jstree", function (e, data) {
  console.log(data.selected);
});

$('button').on('click', function () {
  $('#jstree').jstree(true).select_node('child_node_1');
  $('#jstree').jstree('select_node', 'child_node_1');
  $.jstree.reference('#jstree').select_node('child_node_1');
});

</script>
  <!-- <script src="../library/js_tree/dist/libs/jquery.js"></script>
  <script src="../library/js_tree/dist/jstree.min.js"></script>
  <script>
  $(function () {
    // 6 create an instance when the DOM is ready
    $('#jstree').jstree();
    // 7 bind to events triggered on the tree
    $('#jstree').on("changed.jstree", function (e, data) {
      console.log(data.selected);
    });
    // 8 interact with the tree - either way is OK
    $('button').on('click', function () {
      $('#jstree').jstree(true).select_node('child_node_1');
      $('#jstree').jstree('select_node', 'child_node_1');
      $.jstree.reference('#jstree').select_node('child_node_1');
    });
  }); -->
  </script>
</body>
</html>