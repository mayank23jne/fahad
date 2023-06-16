<template>
    <div class="card p-5">      
      <div class="card-body pt-0">
        <div class="d-flex align-items-center" v-for="(value, index) in permissions" :key="index">
                  <!--begin::Checkbox-->
                  <div  class="mt-5">
              <input class="form-check-input" type="checkbox" :value="value.id" id="flexCheckDefault"  v-model="chossenvalue">
               <label class="form-check-label ms-2" for="flexCheckDefault" v-if="lang === 'ar'">{{value.permission_name}}</label>
               <label class="form-check-label ms-2" for="flexCheckDefault" v-else>{{value.permission_name_en}}</label>
                  </div>
                </div>

                <div class="d-flex justify-content-center mt-20"><button class="btn btn-success" @click="gotopage">{{$t("save")}}</button></div>

      </div>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref, onMounted } from "vue";
  import Datatable from "@/components/kt-datatable/KTDataTable.vue";
  import CategoryAddNewModal from "@/containers/applications/CategoryAddNewModal.vue";
  import ApiService from "@/core/services/ApiService";
import axios from "axios";
import Swal from "sweetalert2";
import { translate } from "element-plus";
import { useI18n } from "vue-i18n";

 interface items{
    id:number;
    permission_name:string;
    permission_name_en:string;
    code:string;
 }

  export default defineComponent({
    name: "permissions",
    props:['user_id'],
    components: {
      Datatable,
      CategoryAddNewModal,
    },
    setup(props) {
      const { t, te } = useI18n();
      const selectedIds = ref<Array<number>>([]);
      const permissions=ref<Array<items>>([]);
      // const tableData = ref<Array<items>>([]);
        const chossenvalue = ref<Array<number>>([]);
       const lang= localStorage.getItem('lang');
          const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };
      onMounted(() => {
        // initCustomers.value.splice(0, tableData.value.length, ...tableData.value);
      ApiService.get("showPermissions")
      .then(({ data }) => {
        permissions.value = data;
        
      });

      ApiService.get("showUsersPermissions?user_id="+props.user_id)
      .then(({ data }) => {
        let ids : any =[];
        data.forEach((item ) => {
          
            ids.push(item.id);
        });
         chossenvalue.value = ids;
        
      });
     
      });

      const gotopage=(e)=>
       {
        ApiService.post("addUserPermission", {
            user_id:props.user_id,
        permissions:chossenvalue.value,
        })
      .then(({ data }) => {
        setTimeout(() => {
          Swal.fire({
            text: translate('savedsuccess'),
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: translate("okgotit"),
            heightAuto: false,
            customClass: {
              confirmButton: "btn btn-primary",
            },
          }).then(() => {
            
          });
        }, 2000);
        
      });

       }


      return {
      
        permissions,
        chossenvalue,
        gotopage,
        translate,
        lang
      };
    },
  });
  </script>
  