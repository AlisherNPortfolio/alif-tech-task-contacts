<template>
    <v-app>
        <v-content>
            <v-container>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse">
                        <div class="navbar-nav">
                            <router-link to="/" class="nav-item nav-link">Home</router-link>
                        </div>
                    </div>
                </nav>
                <router-view> </router-view>
            </v-container>
        </v-content>
    </v-app>
</template>

        <script>
            export default {}
        </script>
