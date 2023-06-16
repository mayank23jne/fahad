import{d as h,ac as g,ab as y,aA as w,u as V,r as _,o as k,G as v,V as I,_ as S,k as F,l as t,m as d,y as A,p as f,n as B,I as r,H as T}from"./index.40c6202a.js";import{S as $}from"./sweetalert2.all.fbc178e9.js";import{c as C,a as D}from"./object.fb242430.js";const E=h({name:"editpropertytype",props:["id"],components:{ErrorMessage:g,Field:y,VForm:w},setup(e){const{t:o,te:b}=V(),s=_(null),m=localStorage.getItem("logged_user_id"),l=_({name_en:"",name_ar:""}),n=a=>b(a)?o(a):a,c=C().shape({name_ar:D().required(n("name_ar_req"))});k(()=>{v.post("showPropertyTypeId",{id:e.id,user_id:m}).then(({data:a})=>{l.value.name_ar=a[0].name_ar,l.value.name_en=a[0].name_en})});const p=()=>{s.value&&(s.value.setAttribute("data-kt-indicator","on"),setTimeout(()=>{var a;(a=s.value)==null||a.removeAttribute("data-kt-indicator")},2e3))},i=()=>{if(s.value){s.value.setAttribute("data-kt-indicator","on");const a=new FormData;a.append("name_en",l.value.name_en),a.append("name_ar",l.value.name_ar),a.append("user_id",m),a.append("id",e.id),v.post("updatePropertyType",a).then(({data:u})=>{setTimeout(()=>{$.fire({text:n("savedsuccess"),icon:"success",buttonsStyling:!1,confirmButtonText:n("okgotit"),heightAuto:!1,customClass:{confirmButton:"btn btn-primary"}}).then(()=>{I.push({name:"propertytype"})})},2e3)}),setTimeout(()=>{var u;(u=s.value)==null||u.removeAttribute("data-kt-indicator")},2e3)}};return _(""),{submitButton1:s,saveChanges1:p,newItem:l,formSubmit:i,profileDetailsValidator:c,translate:n}}});const M={class:"card mb-5 mb-xl-10"},q={id:"kt_account_profile_details",class:"collapse show"},N={class:"card-body border-top p-9"},P={class:"row mb-6"},U={class:"col-lg-4 col-form-label required fw-semobold fs-6"},j={class:"col-lg-8"},G={class:"fv-plugins-message-container"},H={class:"fv-help-block"},z={class:"row mb-6"},J={class:"col-lg-4 col-form-label fw-semobold fs-6"},K={class:"col-lg-8 fv-row"},L={class:"card-footer d-flex justify-content-end py-6 px-9"},O={type:"reset",class:"btn btn-light btn-active-light-primary me-2"},Q={type:"submit",id:"kt_account_profile_details_submit",ref:"submitButton1",class:"btn btn-primary"},R={class:"indicator-label"},W={class:"indicator-progress"},X=t("span",{class:"spinner-border spinner-border-sm align-middle ms-2"},null,-1);function Y(e,o,b,s,m,l){const n=f("Field"),c=f("ErrorMessage"),p=f("VForm");return B(),F("div",M,[t("div",q,[d(p,{id:"kt_account_profile_details_form",class:"form",novalidate:"",onSubmit:o[2]||(o[2]=i=>e.formSubmit()),"validation-schema":e.profileDetailsValidator},{default:A(()=>[t("div",N,[t("div",P,[t("label",U,r(e.translate("name"))+"("+r(e.translate("arabic"))+")",1),t("div",j,[d(n,{type:"text",name:"name_ar",class:"form-control form-control-lg form-control-solid mb-3 mb-lg-0",placeholder:e.translate("name"),modelValue:e.newItem.name_ar,"onUpdate:modelValue":o[0]||(o[0]=i=>e.newItem.name_ar=i)},null,8,["placeholder","modelValue"]),t("div",G,[t("div",H,[d(c,{name:"name_ar"})])])])]),t("div",z,[t("label",J,r(e.translate("name"))+"("+r(e.translate("english"))+")",1),t("div",K,[d(n,{type:"text",name:"name_en",class:"form-control form-control-lg form-control-solid",placeholder:e.translate("name"),modelValue:e.newItem.name_en,"onUpdate:modelValue":o[1]||(o[1]=i=>e.newItem.name_en=i)},null,8,["placeholder","modelValue"])])])]),t("div",L,[t("button",O,r(e.translate("discard")),1),t("button",Q,[t("span",R,r(e.translate("save")),1),t("span",W,[T(r(e.translate("pleasewait"))+" ",1),X])],512)])]),_:1},8,["validation-schema"])])])}const te=S(E,[["render",Y]]);export{te as default};
