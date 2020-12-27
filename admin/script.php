<script type="text/javascript">
	 document.addEventListener('DOMContentLoaded', function() {
   const slider = document.querySelector('.slider');
   M.Slider.init(slider, {
      indicators: true,
      height: 500,
    	transition: 800,
    	interval: 6000,
      fade: false,
    });
  });
</script>

<!-- <script type="text/javascript">
   $(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();
  });
</script> -->

<script type="text/javascript">
    const sideNav = document.querySelector('.sidenav');
    M.Sidenav.init(sideNav, {
        edge:'left',
        menuWidth:200,
                });
   
  </script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelector('.tabs')
    M.Tabs.init(tabs, {
      swipeable: true,
    });
    });
  </script>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    const collapsible = document.querySelectorAll('.collapsible');
     M.Collapsible.init(collapsible, {});
  });
  </script>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    const tooltip = document.querySelectorAll('.tooltipped');
    M.Tooltip.init(tooltip, {});
  });
  </script>

  <script type="text/javascript">

     document.addEventListener('DOMContentLoaded', function() {
    const materialboxed= document.querySelectorAll('.materialboxed');
    M.Materialbox.init(materialboxed, {});
  });
</script>
     
<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    const ss = document.querySelectorAll('.scrollspy');
    M.ScrollSpy.init(ss,{
      scrollOffset: 200,
      throttle: 100
    });
  })
</script>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {

    const modal = document.querySelectorAll('.modal');
    M.Modal.init(modal, {
      height:200,
      opacity: 0,
      dismissible:false,
      overflow:false
    });
  });

</script>


<script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.querySelectorAll('.dropdown-trigger');
    M.Dropdown.init(dropdown, {
        alignment: 'left',
        hover:false,
        coverTrigger: false,
        constrainWidth: false,
    });
  });
</script>

<script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function() {
    const select = document.querySelectorAll('select');
    M.FormSelect.init(select, {});
  });
</script>

<!--
<script type="text/javascript">
     document.addEventListener('DOMContentLoaded', function() {
    const collapsible = document.querySelectorAll('.collapsible');
     M.Collapsible.init(collapsible, {});
  });
</script>
-->

 
