<template>
    <!--begin::Customer-->
    <div  @click="toggleItem($event,data.id)" :class="{'d-flex mb-3':true,'active' : selectedItems.includes(data.id)}" class="card card-flush pt-3 mb-5 mb-lg-10 card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2">
      <!--begin::Card body-->
      <div class="card-body pt-0">
        <!--begin::Description-->
        <!-- <h5>{{ data.status }}</h5> -->
        
        <!--end::Description-->
  
        <!--begin::Selected customer-->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center pb-2 p-3 mb-2">
          <!--begin::Avatar-->
          <router-link  :to="{
           name:'editlist',
            params: {
              id: data.id
            }
           }"
           class="text-gray-600 text-hover-primary mb-1" >
          
          <h2>{{ data.title }}</h2>
           </router-link>
           <div class="text-gray-400 fs-5 fw-semobold mb-13">
           <span >{{data.category}}</span>
           </div>
          <p class="text-gray-400 fs-5 fw-semobold mb-13">
            <span >{{data.date}}</span>
          </p>
          
         <div class="w-15 w-xs-100"><span class="badge badge-light-primary ms-5" :variant="data.labelColor">{{data.label}}</span></div>
          <!--end::Info-->
        </div>
        <!--end::Selected customer-->
  
        <!--begin::Customer add buttons-->
        <!-- <div class="mb-7 d-none">
          <a
            href="#"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#kt_modal_customer_search"
            >Select Customer</a
          >
  
          <span class="fw-bold text-gray-500 mx-2">or</span>
  
          
        </div> -->
        <!--end::Customer add buttons-->
  
        <!--begin::Customer change button-->
        <!-- <div class="mb-10">
          <a
            href="#"
            class="btn btn-light-primary"
            data-bs-toggle="modal"
            data-bs-target="#kt_modal_customer_search"
            >Change Customer</a
          >
        </div> -->
        <div class="card-body pt-1"><p class="mb-0" v-html="data.detail"></p></div>
       
      </div>
      <!--end::Card body-->
    </div>
    <!--end::Customer-->
  </template>
  
  <script lang="ts">
  import { defineComponent, ref } from "vue";
  //import Notice from "@/components/Notice.vue";
  
  export default defineComponent({
    name: "surveylistitem2",
    props: ['data', 'selectedItems'],
    components: {
      //Notice,
    },
    setup(props, { emit }) {
        const data = ref(props.data);
        const selectedItems = ref([props.selectedItems]);
      const body = ref(
        `Writing headlines for blog posts is much science and probably cool audience. <a href="#" class="fw-bold">Learn more</a>.`
      );
       const toggleItem = (event, itemId) => {
          emit('toggle-item', event, itemId)
            }
      return {
        body,
        data, 
        selectedItems,
        toggleItem
      };
    },
  });
  </script>
  