<template>
  <!--begin::Authentication Layout -->
  <div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Body-->
    <div
      class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1"
    >
      <!--begin::Form-->
      <div class="d-flex flex-center flex-column flex-lg-row-fluid">
        <!--begin::Wrapper-->
        <div class="<?php echo $params['wrapperClass']?> p-10">
          <router-view></router-view>
        </div>
        <!--end::Wrapper-->
      </div>
      <!--end::Form-->

      <!--begin::Footer-->
      <div class="d-flex flex-center flex-wrap px-5">
        <!--begin::Links-->
        <div class="d-flex fw-semibold text-primary fs-base">
          <a href="#" class="px-5" target="_blank">{{$t('terms')}}</a>

          <a href="#" class="px-5" target="_blank">{{$t("plans")}}</a>

          <a href="#" class="px-5" target="_blank">{{$t("contactus")}}</a>
        </div>
        <!--end::Links-->
      </div>
      <!--end::Footer-->
    </div>
    <!--end::Body-->

    <!--begin::Aside-->
    <div
      class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
      :style="{ backgroundImage: `url('${G1}')` }"
    >
      <!--begin::Content-->
      <div
        class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100"
      >
        <!--begin::Logo-->
        <!-- <router-link to="/" class="mb-0 mb-lg-12">
          <img
            alt="Logo"
            src="../assets/logos/black.png"
            class="h-60px h-lg-75px"
          />
        </router-link> -->
        <!--end::Logo-->

        <!--begin::Image-->
         <!-- src="/media/misc/auth-screens.png" -->
        <!-- <img
          class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
          src="../assets/img/login/G1.png"
          alt=""
        /> -->
        <!--end::Image-->

        <!--begin::Title-->
        <!-- <h1
          class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7"
        >
          Fast, Efficient and Productive
        </h1> -->
        <!--end::Title-->

        <!--begin::Text-->
        <!-- <div class="d-none d-lg-block text-white fs-base text-center">
          In this kind of post,
          <a href="#" class="opacity-75-hover text-warning fw-bold me-1"
            >the blogger</a
          >

          introduces a person they’ve interviewed <br />
          and provides some background information about

          <a href="#" class="opacity-75-hover text-warning fw-bold me-1"
            >the interviewee</a
          >
          and their <br />
          work following this is a transcript of the interview.
        </div> -->
        <!--end::Text-->
      </div>
      <!--end::Content-->
    </div>
    <!--end::Aside-->
  </div>
  <!--end::Authentication Layout -->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import LayoutService from "@/core/services/LayoutService";
import { useBodyStore } from "@/stores/body";
import G1 from "@/assets/logos/G1Login.png";

export default defineComponent({
  name: "auth-layout",
  components: {},
  setup() {
    const store = useBodyStore();
    const image= "assets/logos/G1Login.png";
    onMounted(() => {
      LayoutService.emptyElementClassesAndAttributes(document.body);

      store.addBodyClassname("app-blank");
      store.addBodyClassname("bg-body");
    });
    return{
      image,
      G1
    }
  },
});
</script>
