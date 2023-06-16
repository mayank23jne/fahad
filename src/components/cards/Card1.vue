<template>
  <!--begin::Card-->
  <div
   class="card border border-2 border-gray-300 border-hover" :style="`height:${height}`">
    <!--begin::Card header-->
    <div class="card-header border-0 " v-if="icon">
      <!--begin::Card Title-->
      <div class="card-title "> 
        <!--begin::Avatar-->
        <div class="d-flex flex-center w-50px h-50px rounded-3  bg-opacity-90 " :class="`bg-light-${color}`">
          <span class="svg-icon svg-icon-3x  p-3" :class="`svg-icon-${color}`">
            <inline-svg :src="icon" />
          </span>
        </div>
        <!-- <div class="symbol symbol-50px w-50px bg-light">
          <img :src="icon" alt="image" class="p-3 text-primary" />
          
        </div> -->
       
      </div>
    
    </div>

    <div class="card-body p-9">
      <!--begin::Name-->
      <div class="fs-3 fw-bold text-dark">
        {{ translate(title) }}
      </div>
     
      <p class="text-gray-400 fw-semobold fs-5 mt-1 mb-7">
        {{ getDescription }}
      </p>
    
    </div>
    <!--end:: Card body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, computed } from "vue";
import { useI18n } from "vue-i18n";

export default defineComponent({
  name: "card-1",
  components: {},
  props: {
    progress: Number,

    statusDataBadgeColor: String,

    statusDataColor: String,

    status: String,

    icon: String,
   
    color: String ,
     
    title: String,

    description: Number,

    date: String,

    budget: String,

    height: String,

    // users: Array as () => Array<any>,
  },
  setup(props) {
    const { t, te } = useI18n();
    const getDescription = computed(() => {
      return props.description
        ? props.description
        : 0;
    });

    const getDate = computed(() => {
      return props.date ? props.date : "Feb 21, 2021";
    });

    const getBudget = computed(() => {
      return props.budget ? props.budget : "$284,900.00";
    });

    const getStatus = computed(() => {
      return props.status ? props.status : "In Progress";
    });

    const getStatusDataBadgeColor = computed(() => {
      return props.statusDataBadgeColor
        ? props.statusDataBadgeColor
        : "badge-light-primary";
    });

    const getStatusDataColor = computed(() => {
      return props.statusDataColor ? props.statusDataColor : "bg-primary";
    });

    const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };


    return {
    
      getDescription,
      getDate,
      getBudget,
      getStatus,
      getStatusDataBadgeColor,
      getStatusDataColor,
      translate
    };
  },
});
</script>
