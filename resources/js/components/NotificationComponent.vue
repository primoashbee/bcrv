<template>
<div>
        <!-- <a class="nav-link" href="/show_notifications">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge" id="newest_requests">0</span>
        </a>

          <li class="nav-item dropdown"> -->
            
    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> 
        <i class="far fa-bell"></i>
         <span class="badge badge-danger navbar-badge" id="newest_requests">{{notifications.filter(x=> x.read_at == null).length}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <div class="list-group">
            <a :href="notification.data.link" @click.prevent = "goToNotification(notification.id)" class="list-group-item list-group-item-action flex-column align-items-start" :class="{ 'active' : className(notification.read_at) }" v-for="notification in notifications">
                <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{notification.data.title}}</h5>
                <small>{{notification.created_at}}</small>
                </div>
                <p class="mb-1">{{notification.data.message}}</p>
                <!-- <small>Donec id elit non mi porta.</small> -->
            </a>

        </div>

      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="/notifications">See all</a>
    </div>
  <!-- </li> -->
  </div>
</template>

<script>
import Axios from 'axios';


export default {
    props: ['user_id','is_admin'],
    async created(){
        if(this.is_admin == "1"){
        Echo.channel('user.notifications.' + this.user_id)
            .listen('.student-uploaded-requirement', (e) => {
                const payload = e;
                console.log(payload)
                this.$toast(e.data.data.message, {
                    timeout: 5000,
                    onClick: ()=> {
                        this.goToNotification(payload.data.id);
                    },
                
                });
                console.log(e)
                this.notifications.unshift(e.data)
            });
        }else{
        Echo.channel('user.notifications.' + this.user_id)
            .listen('.requirement-updated', (e) => {
                const payload = e;
                console.log(e , 'ashbee')
                this.$toast(e.message.message + '['+e.message.title+']', {
                        timeout: 5000,
                        onClick: ()=> {
                            this.goToNotification(payload.data.id)
                        },
                });
                console.log(e , 'ashbee')

                console.log('admin has updated your uploaded')

                this.notifications.unshift(e.data)
            })
        }
        const {data} = await axios.get('/notifications/list')
        console.log(data)
        this.notifications = data.data
    },

    data(){
        return {
            notifications : []
        }
    },
    methods: {
        async goToNotification(notification_id) {
            try{
                const { data } = await axios.patch(`/notification/${notification_id}`);
                window.location.href = data.data.link
            }catch(e){

            }
        },

        className(read_at){
            return read_at != null ? false : true ;
        }
    },

    computed:  {
        list(){
            return this.notifications;
        }
    }
}
</script>