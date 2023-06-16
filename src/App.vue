<template>
  <RouterView />
</template>

<script lang="ts">
import { defineComponent, nextTick, onBeforeMount, onMounted } from "vue";
import { RouterView } from "vue-router";
import { useConfigStore } from "@/stores/config";
import { useThemeStore } from "@/stores/theme";
import { useBodyStore } from "@/stores/body";
import { themeMode } from "@/core/helpers/config";
import { initializeComponents } from "@/core/plugins/keenthemes";
import { getDirection } from "./utils";


export default defineComponent({
  name: "app",
  components: {
    RouterView,
  },
  setup() {
    const configStore = useConfigStore();
    const themeStore = useThemeStore();
    const bodyStore = useBodyStore();
  

  const created = ()=>{
   var hours = 24 as any;  // Reset when storage is more than 24hours
var now = Date.now() as any;
var setupTime = localStorage.getItem('setupTime') as any;
if (setupTime == null)
{
     localStorage.setItem('setupTime', now)
} else if (now - setupTime > 30*60*1000)
 {
     localStorage.removeItem("access_token");
      localStorage.removeItem("loggeduser");
      localStorage.removeItem("logged_user_id");
      localStorage.removeItem("role_id");
      localStorage.removeItem("user");
       localStorage.removeItem('permissions')
    localStorage.removeItem('setupTime');
}
    }

    onBeforeMount(() => {
      /**
       * Overrides the layout config using saved data from localStorage
       * remove this to use static config (@/core/config/DefaultLayoutConfig.ts)
       */

       const direction = getDirection();
    if (direction.isRtl) {
      document.body.classList.add("rtl");
      document.dir = "rtl";
      document.body.classList.remove("ltr");
      setRtlMode();
    } else {
      document.body.classList.add("ltr");
      document.dir = "ltr";
      document.body.classList.remove("rtl");
      setLtrMode();
    }

      configStore.overrideLayoutConfig();

      /**
       *  Sets a mode from configuration
       */
      themeStore.setThemeMode(themeMode.value);
    });
 

    const setRtlMode = () => {
 bodyStore.addBodyClassname("page-loading");
 var link = document.getElementById("main-css");
 link?.setAttribute("href", "/style.bundle.rtl.css");
 document.documentElement.setAttribute("dir", "rtl");
 document.documentElement.setAttribute("direction", "rtl");
 document.documentElement.setAttribute("style", "direction:rtl");
 setTimeout(() => {
 bodyStore.removeBodyClassName("page-loading");
 }, 1000);
 };
 const setLtrMode = () => {
 bodyStore.addBodyClassname("page-loading");
 var link = document.getElementById("main-css");
 document.documentElement.removeAttribute("dir");
 document.documentElement.removeAttribute("direction");
 document.documentElement.removeAttribute("style");
 link?.setAttribute("href", "/style.bundle.css");
 setTimeout(() => {
 bodyStore.removeBodyClassName("page-loading");
 }, 1000);
}

    onMounted(() => {
//       var hours = 24 as any;  // Reset when storage is more than 24hours
// var now = Date.now() as any;
// var setupTime = localStorage.getItem('setupTime') as any;
// if (setupTime == null)
// {
//      localStorage.setItem('setupTime', now);
// } else if ((now - setupTime > 30*60*1000) || setupTime!="")
//  {
//      localStorage.removeItem("access_token");
//       localStorage.removeItem("loggeduser");
//       localStorage.removeItem("logged_user_id");
//       localStorage.removeItem("role_id");
//       localStorage.removeItem("user");
//        localStorage.removeItem('permissions')
//     localStorage.removeItem('setupTime');
// }
      nextTick(() => {
        initializeComponents();

        bodyStore.removeBodyClassName("page-loading");
      });
    });
  },
});
</script>

<style lang="scss">
@import "bootstrap-icons/font/bootstrap-icons.css";
@import "apexcharts/dist/apexcharts.css";
@import "quill/dist/quill.snow.css";
@import "animate.css";
@import "sweetalert2/dist/sweetalert2.css";
@import "nouislider/distribute/nouislider.css";
@import "@fortawesome/fontawesome-free/css/all.min.css";
@import "socicon/css/socicon.css";
@import "line-awesome/dist/line-awesome/css/line-awesome.css";
@import "dropzone/dist/dropzone.css";
@import "@vueform/multiselect/themes/default.css";
@import "prism-themes/themes/prism-shades-of-purple.css";
@import "element-plus/dist/index.css";

// Main demo style scss
// @import "assets/fonticon/fonticon.css";
@import "assets/sass/element-ui.dark";
// @import "assets/sass/plugins";
// @import "assets/sass/style";

#app {
  display: contents;
}
</style>
