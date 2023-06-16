<template>
  <!--begin::Menu-->
  <div
    class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px"
    data-kt-menu="true"
  >
    <!--begin::Heading-->
    <div
      class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10"
      style="background-image: url('/media/misc/menu-header-bg.jpg')"
    >
      <!--begin::Title-->
      <h3 class="text-white fw-semobold ">{{$t("quicklink")}}</h3>
      <!--end::Status-->
    </div>
    <!--end::Heading-->
    <div class="scroll-y mh-325px my-5 px-8">
    <!--begin:Nav-->
    <div class="row g-0">
      <!--begin:Item-->
      <div class="col-6">
        <router-link to="/dashboard/Em_default"
         class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom" >
         <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
            <inline-svg src="/media/icons/duotune/ecommerce/ecm004.svg" />
          </span>
          <span class="fs-5 fw-semobold text-gray-800 mb-0"> {{$t('generalproportion')}}</span>
           </router-link>
        <!-- <a
          href="#"
         
        >
          <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
            <inline-svg src="/media/icons/duotune/ecommerce/ecm004.svg" />
          </span> -->
          <!-- <i class="ki-duotone ki-
                            shop                        ">
 <i class="path1"></i>
 <i class="path2"></i>
 <i class="path3"></i>
 <i class="path4"></i>
 <i class="path5"></i>
</i> -->
          <!-- <span class="fs-5 fw-semobold text-gray-800 mb-0"> النسب العامة طواري</span> -->
          <!-- <span class="fs-7 text-gray-400">eCommerce</span> -->
        <!-- </a> -->
      </div>
      <!--end:Item-->
      <!--begin:Item-->
      <div class="col-6">
        <router-link to="/dashboard/default"
          class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom"
        >
          <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
            <inline-svg src="/media/icons/duotune/abstract/abs028.svg" />
          </span>
          <span class="fs-5 fw-semobold text-gray-800 mb-0"> {{$t("generalpresources")}}</span>
          <!-- <span class="fs-7 text-gray-400">eCommerce</span> -->
        </router-link>
      </div>
      <!--end:Item-->
      <!--begin:Item-->
      <div class="col-6">
        <router-link to="/app/reports/units_status_em"
          class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom"
        >
          <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
            <inline-svg src="/media/icons/duotune/graphs/gra001.svg" />
          </span>
          <span class="fs-5 fw-semobold text-gray-800 mb-0">{{$t('achievementratios')}}</span>
          <!-- <span class="fs-7 text-gray-400">eCommerce</span> -->
        </router-link>
      </div>
      <!--end:Item-->

      <!--begin:Item-->
      <div class="col-6">
        <router-link to="/app/reports/units_status_hr"
          class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom"
        >
          <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
            <inline-svg src="/media/icons/duotune/graphs/gra004.svg" />
          </span>
          <span class="fs-5 fw-semobold text-gray-800 mb-0"
            >{{ $t('generalcompletion') }}</span
          >
          <!-- <span class="fs-7 text-gray-400">Console</span> -->
        </router-link>
      </div>
      <!--end:Item-->

      <!--begin:Item-->
      <div class="col-6">
        <router-link to="/apps/applications/Contractor_ratios"
          class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end"
        >
          <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
            <inline-svg src="/media/icons/duotune/abstract/abs046.svg" />
          </span>
          <span class="fs-5 fw-semobold text-gray-800 mb-0">{{$t('accomplishmentcontractor')}}</span>
          
        </router-link>
      </div>
      <!--end:Item-->

      <!--begin:Item-->
      <div class="col-6">
        <router-link to="/apps/reports/surveylistforreport"
          class="d-flex flex-column flex-center h-100 p-6 bg-hover-light"
        >
          <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
            <inline-svg src="/media/icons/duotune/graphs/gra011.svg" />
          </span>
          <span class="fs-5 fw-semobold text-gray-800 mb-0"> {{$t('surveylistforreport')}}</span>
          <!-- <span class="fs-7 text-gray-400">Latest cases</span> -->
        </router-link>
      </div>
      <!--end:Item-->
       <!--begin:Item-->
      <div class="col-6">
        <router-link to="/apps/applications/todo"
          class="d-flex flex-column flex-center h-100 p-6 bg-hover-light"
        >
          <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
            <inline-svg src="/media/icons/duotune/files/fil001.svg" />
          </span>
          <span class="fs-5 fw-semobold text-gray-800 mb-0">{{$t("todolist")}}</span>
          <!-- <span class="fs-7 text-gray-400">Latest cases</span> -->
        </router-link>
      </div>
      <!--end:Item-->
    </div>
    </div>

  </div>
  <!--end::Menu-->
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "kt-quick-links-menu",
  components: {},
});
</script>
