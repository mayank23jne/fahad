<template>
    <div
      class="modal fade"
      id="kt_modal_add_registeredproperty"
      ref="addregisteredpropertyModalRef"
      tabindex="-1"
      aria-hidden="true"
    >
      <!--begin::Modal dialog-->
      <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
          <!--begin::Modal header-->
          <div class="modal-header" id="kt_modal_add_customer_header">
            <!--begin::Modal title-->
            <h2 class="fw-bold">{{translate('addregisteredproperty')}}</h2>
            <!--end::Modal title-->
  
            <!--begin::Close-->
            <div
              id="kt_modal_add_registeredproperty_close"
              data-bs-dismiss="modal"
              class="btn btn-icon btn-sm btn-active-icon-primary"
            >
              <span class="svg-icon svg-icon-1">
                <inline-svg src="/media/icons/duotune/arrows/arr061.svg" />
              </span>
            </div>
            <!--end::Close-->
          </div>
          <!--end::Modal header-->
          <!--begin::Form-->
          <el-form
            @submit.prevent="submit()"
            :model="newItem"
            :rules="rules"
            ref="formRef"
          >
            <!--begin::Modal body-->
            <div class="modal-body py-10 px-lg-17">
              <!--begin::Scroll-->
              <div
                class="scroll-y me-n7 pe-7"
                id="kt_modal_add_industrytype_scroll"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}"
                data-kt-scroll-max-height="auto"
                data-kt-scroll-dependencies="#kt_modal_add_registeredproperty_header"
                data-kt-scroll-wrappers="#kt_modal_add_registeredproperty_scroll"
                data-kt-scroll-offset="300px"
              >
                <div class="row mb-7">
                  <!--begin::Label-->
                  <label class="col-lg-4 required fs-6 fw-semobold mb-2">{{translate('selectpropertytype')}}</label>
                  <div class="col-lg-8 fv-row">
                    <el-form-item prop="unittype">
                   
                    <el-select v-model="newItem.unittype" :options="units" @change="onChangeSelect($event)"  :popper-append-to-body="false"
                     :teleported="false">
                      <template v-for="(unit) in units" :key="unit.id">
                        <el-option :value="unit.id"  :label=" unit.building_number">{{ unit.building_number }}</el-option>
                      </template>
                      </el-select>
                    </el-form-item>
                </div>
                </div>
                <div class="row mb-7">
                  <!--begin::Label-->
                 
                    <label class="col-lg-4 required fs-6 fw-semobold mb-2">{{translate('buildingname')}}</label>
                
                  <div class="col-lg-8 fv-row">
                  <el-form-item prop="buildingname">
                    <el-input
                      v-model="newItem.building_name"
                      type="text"
                      name="buildingname"
                      placeholder=""
                    />
                  </el-form-item>
                  </div>
                </div> 
                <!-- <div class="row mb-7">
                 
                  <label class="col-lg-4  fs-6 fw-semobold mb-2">{{translate('name')}}({{translate('english')}})</label>
                  <div class="col-lg-8 fv-row">
                  <el-form-item prop="propertyname_en">
                    <el-input
                      v-model="newItem.propertyname_en"
                      type="text"
                      name="propertyname_en"
                      placeholder=""
                    />
                  </el-form-item>
                </div>
                </div> -->
                <div class="row mb-7">
                  <!--begin::Label-->
                  <label class="col-lg-4 required fs-6 fw-semobold mb-2">{{translate('owner')}}</label>
                  <div class="col-lg-8 fv-row">
                  <el-form-item prop="owner">
                    <el-input
                      v-model="newItem.owner"
                      type="text"
                      name="owner"
                      placeholder=""
                    />
                  </el-form-item>
                  </div>
                </div>
                <div class="row mb-7">
                  <!--begin::Label-->
                  <label class="col-lg-4 required fs-6 fw-semobold mb-2">{{translate('representative')}}</label>
                  <div class="col-lg-8 fv-row">
                  <el-form-item prop="representative">
                    <el-input
                      v-model="newItem.representative"
                      type="text"
                      name="representative"
                      placeholder=""
                    />
                  </el-form-item>
                  </div>
                </div>
                <div class="row mb-7">
                  <!--begin::Label-->
                 
                    <label class="col-lg-4 required fs-6 fw-semobold mb-2">{{translate('licenseno')}}</label>
                
                  <div class="col-lg-8 fv-row">
                  <el-form-item prop="permitno">
                    <el-input
                      v-model="newItem.permitno"
                      type="text"
                      name="permitno"
                      placeholder=""
                    />
                  </el-form-item>
                  </div>
                </div> 
                <!-- <div class="row mb-7">
                  
                  <label class="col-lg-4  fs-6 fw-semobold mb-2">{{translate('owner')}}({{translate('english')}})</label>
                  <div class="col-lg-8 fv-row">
                  <el-form-item prop="owner_en">
                    <el-input
                      v-model="newItem.owner_en"
                      type="text"
                      name="owner_en"
                      placeholder=""
                    />
                  </el-form-item>
                </div>
                </div> -->
               
                <div class=" fv-row mb-4 text-right " style=" margin-left: 77%;">
                  <button
                 
                  type="button"
                  class="btn btn-sm btn-flex btn-light-primary"
                  @click="add"
                >
                  <span class="svg-icon svg-icon-3">
                    <inline-svg src="/media/icons/duotune/general/gen035.svg" />
                  </span>
                  {{translate("addfields")}}
                </button>
                </div>
                <div v-for="(a,index) in newItem.fields" :key="index">
                <div class="row mb-4">
                  <!--begin::Label-->
                  <label class="col-lg-4 required fs-6 fw-semobold mb-2">{{translate('list')}}</label>
                  <div class="col-lg-8 fv-row">
                  <el-form-item prop="list">
                    <el-input
                      v-model="a.list"
                      type="text"
                      name="list"
                      placeholder=""
                    />
                  </el-form-item>
                </div>
                </div>
                <div class="row mb-4">
                 <!--begin::Label-->
                  <label class="col-lg-4 required fs-6 fw-semobold mb-2">{{translate('noofpeople')}}</label>
                  <div class="col-lg-8 fv-row">
                  <el-form-item prop="noofpeople">
                    <el-input
                      v-model="a.noofpeople"
                      type="text"
                      name="noofpeople"
                      placeholder=""
                    />
                  </el-form-item> 
                </div>
                </div>
                <span class="badge badge-pill mb-5" style="      margin-left: 93%;"  @click="deletefields(a.id,index)"><i class="fa fa-trash me-1  fs-5"></i></span>
              </div>
              </div>
              <!--end::Scroll-->
            </div>
            <!--end::Modal body-->
  
            <!--begin::Modal footer-->
            <div class="modal-footer flex-center">
              <!--begin::Button-->
              <button
                type="reset"
                id="kt_modal_add_registeredproperty_cancel"
                class="btn btn-light me-3"
                @click="cancelprocess()"
              >
              {{translate('cancel')}}
              </button>
              <!--end::Button-->
  
              <!--begin::Button-->
              <button
                :data-kt-indicator="loading ? 'on' : null"
                class="btn btn-lg btn-primary"
                type="submit"
              >
                <span v-if="!loading" class="indicator-label">
                  {{translate('save')}}
                  <span class="svg-icon svg-icon-3 ms-2 me-0">
                    <inline-svg src="/media/icons/duotune/arrows/arr064.svg" />
                  </span>
                </span>
                <span v-if="loading" class="indicator-progress">
                  {{translate('pleasewait')}}
                  <span
                    class="spinner-border spinner-border-sm align-middle ms-2"
                  ></span>
                </span>
              </button>
              <!--end::Button-->
            </div>
            <!--end::Modal footer-->
          </el-form>
          <!--end::Form-->
        </div>
      </div>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref } from "vue";
  import { hideModal } from "@/core/helpers/dom";
  import Swal from "sweetalert2";
import ApiService from "@/core/services/ApiService";
import { translate } from "element-plus";
import { useI18n } from "vue-i18n";
import { filterFields } from "element-plus/es/components/form/src/utils";


interface fields{
         id:number;
         list:string;
        noofpeople:string;
  }
   
  interface newItem{
        building_number:string;
        unittype:string;
        building_name:string;
        owner:string;
        client_id:string;
        permitno:string;
        representative:string;
        fields:fields[],
        // list:string;
        // noofpeople:string;
  }
  

  export default defineComponent({
    name: "add-registeredproperty-modal",
    components: {},
    props:['registeredproperty', 'units', 'propertytype',"clientname"],
   

    setup(props, {emit}) {
      const formRef = ref<null | HTMLFormElement>(null);
      const addregisteredpropertyModalRef = ref<null | HTMLElement>(null);
      const loading = ref<boolean>(false);
      const successmessage=ref<boolean>(false);
      const lang = localStorage.getItem('lang');
        const user_id = localStorage.getItem('logged_user_id')  as string;
        const { t, te } = useI18n();
        const translate = (text: string|any) => {
      if (te(text)) {
        return t(text);
      } else {
        return text;
      }
    };
      const newItem = ref<newItem>({ 
        building_number:'',
        unittype:'',
        building_name:'',
        owner:'',
        client_id:'',
        permitno:'',
        representative:'',
        fields:[{
          id:1,
          list:'',
          noofpeople:''
        }],
      });
  
      const rules = ref({
        // propertyname_en: [
        //   {
        //     required: true,
        //     message: translate('name_en_req'),
        //     trigger: "change",
        //   },
        // ],
        unittype: [
          {
            required: true,
            message: translate('reqselectproperty'),
            trigger: "change",
          },
        ],
        // owner_en: [
        //   {
        //     required: true,
        //     message: translate('ownerreq_en'),
        //     trigger: "change",
        //   },
        // ],
        owner: [
          {
            required: true,
            message: translate('owner_req'),
            trigger: "change",
          },
        ],
        permitno: [
          {
            required: true,
            message: translate('permitnoreq'),
            trigger: "change",
          },
        ],
        // noofpeople: [
        //   {
        //     required: true,
        //     message: translate('noofpreq'),
        //     trigger: "change",
        //   },
        // ],
      });

      
      const add = ()=>
     {
      newItem.value.fields.push({
        "id":newItem.value.fields.length+1,
        "list": "",
        "noofpeople":''
      })
    //  fields.value.push({
    //   "list": fields.value.length+1,
    //   "noofpeople":''
    //  });

      // data.answers.push({ value: data.answers.length + 1, label: '' })
    } 

    const onChangeSelect = (e)=>{
      // console.log('onchanges', e);
      props.units.map((item,index) => {
        // console.log(item);
        if(item.id === e){
         newItem.value.building_number= item.building_number;
         newItem.value.building_name= item.building_name;
         newItem.value.client_id=item.client_id;
        //  newItem.value.owner= 
         newItem.value.permitno= item.permissions;
         newItem.value.representative= item.representative;
         props.clientname.map((client,index) => {
          // console.log(client.id,item.client_id )
           if(client.id === Number(item.client_id) ){
            // console.log('fullname',client.fullName)
            newItem.value.owner= client.fullName;
           }
         });
        //  console.log('owner', newItem.value.owner);
        }
      });
    }

    const deletefields = (value,e)=> {
   
      newItem.value.fields.splice(e,1)
    }


      const submit = () => {
        if (!formRef.value) {
          return;
        }
             const array = [props.registeredproperty];
            // let a1="";
        formRef.value.validate((valid: boolean) => {
          if (valid) {
            // const date = new Date();
         //   let data = 30;
         console.log(  'name_en', newItem.value.building_number,
                'permitno',newItem.value.permitno,
                'representative',newItem.value.representative,

                'unittype', newItem.value.unittype,
              )
            loading.value = true;
            ApiService.post("createRegisteredProperty", {
              building_number : newItem.value.building_number,
              building_name : newItem.value.building_name,
              owner : newItem.value.owner,
                permitno :newItem.value.permitno,
                representative:newItem.value.representative,
                client_id: newItem.value.client_id,
                unittype : newItem.value.unittype,
                fields:newItem.value.fields,
                // lists:newItem.value.list,
                // noofpeople:newItem.value.noofpeople,
                user_id:user_id})
        .then(({ data }) => 
            {
              console.log('submitdata', data);
              props.registeredproperty.push({
                'created_at': data.created_at,
                'id': data.id,
                'is_deleted': data.is_deleted,
                'building_no': data.building_no,
                'building_name': data.building_name,
                'owner': data.owner,
                'permitno': data.permitno,
                'representative': data.representative,
                'unitid': data.unitid,
                'status':  "1",
                'updated_at': data.updated_at,
                'user_id': data.user_id,
                })
              
      

      setTimeout(() => {
              loading.value = false;
              formRef.value?.resetFields();
            //   newItem.value = {
            //     propertyname_ar: "",
            //     propertyname_en: "",
            //     owner_ar:'',
            //     owner_en:'',
            //     propertytype:'',
            //     unittype:'',
            //     fields:[],
            //     // list:'',
            //     // noofpeople:'',
            // };
              Swal.fire({
                text: translate('savesuccess'),
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: translate('okgotit'),
                heightAuto: false,
                customClass: {
                  confirmButton: "btn btn-primary",
                },
              }).then(() => {
                hideModal(addregisteredpropertyModalRef.value);
              });
            }, 2000);  

             })
              
              .catch(({ response }) => {
              });
            }
        });
      };
  

      const cancelprocess = () =>
       {
          hideModal(addregisteredpropertyModalRef.value);

       }

      return {
        newItem,
        rules,
        submit,
        formRef,
        loading,
        addregisteredpropertyModalRef,
        translate,
        deletefields,
        lang,
        add,
        onChangeSelect,
        cancelprocess
      };
    },
  });
  </script>
  