import{S as n}from"./sweetalert2.all.fbc178e9.js";import{d as m,r as s,ay as c,az as d}from"./index.40c6202a.js";import{h as g}from"./dom.d7d6c49b.js";const b=m({name:"export-customers-modal",components:{},setup(){const r=s(null),a=s(!1),o=c({shortcuts:[{text:"Last week",value:()=>{const t=new Date,e=new Date;return e.setTime(e.getTime()-3600*1e3*24*7),[e,t]}},{text:"Last month",value:()=>{const t=new Date,e=new Date;return e.setTime(e.getTime()-3600*1e3*24*30),[e,t]}},{text:"Last 3 months",value:()=>{const t=new Date,e=new Date;return e.setTime(e.getTime()-3600*1e3*24*90),[e,t]}}]}),i=s({dateRange:[],exportFormat:"",paymentType:""}),u=s({dateRange:[{required:!0,message:"Date range is required",trigger:"change"}]}),l=()=>{!r.value||r.value.validate(t=>{if(t)a.value=!0,setTimeout(()=>{a.value=!1,n.fire({text:"Form has been successfully submitted!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",heightAuto:!1,customClass:{confirmButton:"btn btn-primary"}}).then(()=>{window.location.reload()})},2e3);else return n.fire({text:"Sorry, looks like there are some errors detected, please try again.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",heightAuto:!1,customClass:{confirmButton:"btn btn-primary"}}),!1})};return{...d(o),formData:i,rules:u,submit:l,formRef:r,loading:a}}});const y=m({name:"add-customer-modal",components:{},setup(){const r=s(null),a=s(null),o=s(!1),i=s({name:"Sean Bean",email:"sean@dellito.com",description:"",addressLine:"101, Collins Street",addressLine2:"",town:"Melbourne",state:"Victoria",postCode:"3000",country:"US"}),u=s({name:[{required:!0,message:"Customer name is required",trigger:"change"}],email:[{required:!0,message:"Customer email is required",trigger:"change"}],addressLine:[{required:!0,message:"Address 1 is required",trigger:"change"}],town:[{required:!0,message:"Town is required",trigger:"change"}],state:[{required:!0,message:"State is required",trigger:"change"}],postCode:[{required:!0,message:"Post code is required",trigger:"change"}]});return{formData:i,rules:u,submit:()=>{!r.value||r.value.validate(t=>{if(t)o.value=!0,setTimeout(()=>{o.value=!1,n.fire({text:"Form has been successfully submitted!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",heightAuto:!1,customClass:{confirmButton:"btn btn-primary"}}).then(()=>{g(a.value)})},2e3);else return n.fire({text:"Sorry, looks like there are some errors detected, please try again.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",heightAuto:!1,customClass:{confirmButton:"btn btn-primary"}}),!1})},formRef:r,loading:o,addCustomerModalRef:a}}});export{b as _,y as a};
