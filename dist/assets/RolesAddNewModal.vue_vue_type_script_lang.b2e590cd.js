import{h as i}from"./dom.d7d6c49b.js";import{S as v}from"./sweetalert2.all.fbc178e9.js";import{d as p,r as e,u as _,G as g}from"./index.40c6202a.js";const y=p({name:"add-roles-modal",components:{},props:["items"],setup(m){const s=e(null),l=e(null),t=e(!1);e(!1);const{t:c,te:f}=_(),a=o=>f(o)?c(o):o,r=e({role_name:""}),d=e({role_name:[{required:!0,message:a("reqscore"),trigger:"change"}]});return{cancelrole:()=>{r.value.role_name="",i(l.value)},saverole:()=>{!s.value||s.value.validate(o=>{o&&(t.value=!0,g.post("addRole",{role_name:r.value.role_name}).then(({data:n})=>{m.items.push({role_name:n.role_name,id:n.id}),setTimeout(()=>{var u;t.value=!1,r.value={role_name:""},(u=s.value)==null||u.resetFields(),v.fire({text:a("savesuccess"),icon:"success",buttonsStyling:!1,confirmButtonText:a("okgotit"),heightAuto:!1,customClass:{confirmButton:"btn btn-primary"}}).then(()=>{i(l.value)})},2e3)}))})},rules:d,formRef:s,loading:t,addRolesModalRef:l,role:r,translate:a}}});export{y as _};
