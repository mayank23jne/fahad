import{D as _}from"./KTDataTable.c04eda30.js";import{C as k}from"./CategoryAddNewModal.aa6e8651.js";import{d as v,u as b,r as d,o as y,G as u,_ as C,k as n,l as a,F as D,J as w,I as m,n as r,z as S,aw as B}from"./index.40c6202a.js";import{S as $}from"./sweetalert2.all.fbc178e9.js";import"./dom.d7d6c49b.js";const x=v({name:"permissions",props:["user_id"],components:{Datatable:_,CategoryAddNewModal:k},setup(e){const{t:o,te:p}=b();d([]);const l=d([]),i=d([]),f=localStorage.getItem("lang"),t=s=>p(s)?o(s):s;return y(()=>{u.get("showPermissions").then(({data:s})=>{l.value=s}),u.get("showUsersPermissions?user_id="+e.user_id).then(({data:s})=>{let c=[];s.forEach(g=>{c.push(g.id)}),i.value=c})}),{permissions:l,chossenvalue:i,gotopage:s=>{u.post("addUserPermission",{user_id:e.user_id,permissions:i.value}).then(({data:c})=>{setTimeout(()=>{$.fire({text:t("savedsuccess"),icon:"success",buttonsStyling:!1,confirmButtonText:t("okgotit"),heightAuto:!1,customClass:{confirmButton:"btn btn-primary"}}).then(()=>{})},2e3)})},translate:t,lang:f}}}),A={class:"card p-5"},I={class:"card-body pt-0"},M={class:"mt-5"},P=["value"],U={key:0,class:"form-check-label ms-2",for:"flexCheckDefault"},E={key:1,class:"form-check-label ms-2",for:"flexCheckDefault"},F={class:"d-flex justify-content-center mt-20"};function N(e,o,p,l,i,f){return r(),n("div",A,[a("div",I,[(r(!0),n(D,null,w(e.permissions,(t,h)=>(r(),n("div",{class:"d-flex align-items-center",key:h},[a("div",M,[S(a("input",{class:"form-check-input",type:"checkbox",value:t.id,id:"flexCheckDefault","onUpdate:modelValue":o[0]||(o[0]=s=>e.chossenvalue=s)},null,8,P),[[B,e.chossenvalue]]),e.lang==="ar"?(r(),n("label",U,m(t.permission_name),1)):(r(),n("label",E,m(t.permission_name_en),1))])]))),128)),a("div",F,[a("button",{class:"btn btn-success",onClick:o[1]||(o[1]=(...t)=>e.gotopage&&e.gotopage(...t))},m(e.$t("save")),1)])])])}const J=C(x,[["render",N]]);export{J as default};
