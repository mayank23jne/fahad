import{d as b,ac as y,ab as v,aA as h,u as w,r as p,o as V,G as f,V as k,_ as I,k as S,l as o,m as c,y as F,p as _,n as A,I as r,H as B}from"./index.40c6202a.js";import{S as $}from"./sweetalert2.all.fbc178e9.js";import{c as C,a as T}from"./object.fb242430.js";const D=b({name:"editcategory",props:["id"],components:{ErrorMessage:y,Field:v,VForm:h},setup(t){const{t:a,te:g}=w(),s=p(null);localStorage.getItem("logged_user_id");const n=p({category:"",category_en:""}),l=e=>g(e)?a(e):e,i=C().shape({category:T().required(l("name_req"))});V(()=>{f.post("category/showbyId",{id:t.id}).then(({data:e})=>{console.log("show by",e),n.value.category=e.category,n.value.category_en=e.category_en})});const d=()=>{s.value&&(s.value.setAttribute("data-kt-indicator","on"),setTimeout(()=>{var e;(e=s.value)==null||e.removeAttribute("data-kt-indicator")},2e3))},m=()=>{if(s.value){s.value.setAttribute("data-kt-indicator","on");const e=new FormData;e.append("category",n.value.category),e.append("category_en",n.value.category_en),f.post("category/update/"+t.id,e).then(({data:u})=>{setTimeout(()=>{$.fire({text:l("savedsuccess"),icon:"success",buttonsStyling:!1,confirmButtonText:l("okgotit"),heightAuto:!1,customClass:{confirmButton:"btn btn-primary"}}).then(()=>{k.push({name:"category"})})},2e3)}),setTimeout(()=>{var u;(u=s.value)==null||u.removeAttribute("data-kt-indicator")},2e3)}};return p(""),{submitButton1:s,saveChanges1:d,newItem:n,formSubmit:m,profileDetailsValidator:i,translate:l}}});const E={class:"card mb-5 mb-xl-10"},M={id:"kt_account_profile_details",class:"collapse show"},q={class:"card-body border-top p-9"},N={class:"row mb-6"},U={class:"col-lg-4 col-form-label required fw-semobold fs-6"},j={class:"col-lg-8"},G={class:"fv-plugins-message-container"},H={class:"fv-help-block"},z={class:"row mb-6"},J={class:"col-lg-4 col-form-label fw-semobold fs-6"},K={class:"col-lg-8"},L={class:"card-footer d-flex justify-content-end py-6 px-9"},O={type:"reset",class:"btn btn-light btn-active-light-primary me-2"},P={type:"submit",id:"kt_account_profile_details_submit",ref:"submitButton1",class:"btn btn-primary"},Q={class:"indicator-label"},R={class:"indicator-progress"},W=o("span",{class:"spinner-border spinner-border-sm align-middle ms-2"},null,-1);function X(t,a,g,s,n,l){const i=_("Field"),d=_("ErrorMessage"),m=_("VForm");return A(),S("div",E,[o("div",M,[c(m,{id:"kt_account_profile_details_form",class:"form",novalidate:"",onSubmit:a[2]||(a[2]=e=>t.formSubmit()),"validation-schema":t.profileDetailsValidator},{default:F(()=>[o("div",q,[o("div",N,[o("label",U,r(t.translate("category"))+"("+r(t.translate("arabic"))+")",1),o("div",j,[c(i,{type:"text",name:"category",class:"form-control form-control-lg form-control-solid mb-3 mb-lg-0",placeholder:t.translate("category"),modelValue:t.newItem.category,"onUpdate:modelValue":a[0]||(a[0]=e=>t.newItem.category=e)},null,8,["placeholder","modelValue"]),o("div",G,[o("div",H,[c(d,{name:"category"})])])])]),o("div",z,[o("label",J,r(t.translate("category"))+"("+r(t.translate("english"))+")",1),o("div",K,[c(i,{type:"text",name:"category_en",class:"form-control form-control-lg form-control-solid mb-3 mb-lg-0",placeholder:t.translate("category"),modelValue:t.newItem.category_en,"onUpdate:modelValue":a[1]||(a[1]=e=>t.newItem.category_en=e)},null,8,["placeholder","modelValue"])])])]),o("div",L,[o("button",O,r(t.translate("discard")),1),o("button",P,[o("span",Q,r(t.translate("save")),1),o("span",R,[B(r(t.translate("pleasewait"))+" ",1),W])],512)])]),_:1},8,["validation-schema"])])])}const ee=I(D,[["render",X]]);export{ee as default};
