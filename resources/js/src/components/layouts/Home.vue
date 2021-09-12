<template>
    <v-app>
        <v-main>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <router-link to="/" class="nav-item nav-link">Home</router-link>
                        <router-link to="/contacts" class="nav-item nav-link">Contacts</router-link>
                    </div>
                </div>
            </nav>
            <router-view></router-view>
        </v-main>
        <notification />
    </v-app>
</template>
<script>
import Notification from './../shared-components/Notification';
export default {
    name: 'Home',
    components: {Notification}
}
</script>
