<template>
    <!--<div class="container">
        <div class="alert text-uppercase copySuccess" :class="isError ? `alert-danger` : `alert-success`" role="alert">
            {{alertMessage}}
        </div>
        <div class="row justify-content-center my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Access Token</div>
                    <div class="card-body">
                        <p>If you wish to use 3rd party services to call the api, please feel free to copy the
                            token, just don't forget to add "Bearer " before sending it.</p>
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   :value="accessToken" id="accessToken">
                            <span class="input-group-btn">
                                <button @click="copyToken()" class="btn btn-default"
                                        type="button"
                                        id="copy-button"
                                        data-toggle="tooltip"
                                        data-placement="button"
                                        title="Copy to Clipboard"
                                ><i class="fas fa-clipboard"></i>&nbsp;&nbsp;Copy to clipboard
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center no-gutters integerInfo">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Current Integer</div>
                    <div class="card-body">
                        <h1 class="text-center">{{currentToken}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Update Integer</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input @keydown="$event.key === 'Enter' ? updateInteger() : false"
                                   type="number"
                                   min="1"
                                   class="form-control"
                                   id="updateInteger"
                                   placeholder="Type an integer"
                            >
                            <span class="input-group-btn">
                                <button @click="updateInteger()" class="btn btn-primary text-capitalize"
                                        type="button"
                                        id="updateIntegerButton"
                                ><i class="fas fa-refresh"></i>&nbsp;&nbsp;update token
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-capitalize">next integer</div>
                    <div class="card-body text-center">
                        <button @click="getNextInteger()"
                                class="btn btn-primary text-capitalize"
                                :disabled="onCall"
                        >get next token
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <div class="container">
        <div class="row text-center my-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search For a Podcast" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-success" type="button">Button</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div v-for="(podcast, index) in feeds">
               <h1>{{index}}</h1>
                <h2>{{podcast.author}}</h2>
                <img @load="checkImage(podcast.image)" class="img-thumbnail" :src="podcast.image">
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "App",
        data() {
            return {
                accessToken: null,
                currentToken: null,
                axiosConfig: null,
                updatePayload: null,
                onCall: false,
                alertMessage: '',
                isError: null,
                podcastData:null,
                feeds:[],
            }
        },
        mounted() {
            this.accessToken = accessToken;
            this.podcastData = podcastResponse;
            this.feeds = this.podcastData.feeds;
        },
        methods: {
            getCurrentToken() {
                axios.defaults.headers.common = {'Authorization': `Bearer ${accessToken}`}
                axios.post('/api/current')
                    .then(res => {
                        this.currentToken = res.data.data.integer;
                    })
                    .catch(err => console.log(err))
            },
            getNextInteger() {
                this.onCall = true;
                axios.post('/api/next')
                    .then(res => {
                        this.currentToken = res.data.data.integer;
                    })
                    .catch(err => console.log(err))
                    .finally(fin => {
                        this.onCall = false
                    })
            },
            updateInteger() {
                const updated_integer = parseInt($("#updateInteger").val());
                if (isNaN(updated_integer) || updated_integer < 0) {
                    this.isError = true;
                    this.alertMessage = `Please insert a positive integer before updating`
                    return  this.animateAlert();
                }
                this.onCall = true;
                axios.post('/api/update', {updated_integer})
                    .then(res => {
                        this.currentToken = res.data.data.integer;
                    })
                    .catch(err => console.log(err))
                    .finally(fin => {
                        this.onCall = false
                    })
            },
            animateAlert(){
                $('.copySuccess').stop().animate({
                        opacity: 1
                    },
                    700,
                    function () {
                        $(this).delay(1000).animate({opacity: 0})
                    });
            },
            copyToken() {
                const el = document.createElement('textarea');
                el.value = this.accessToken;
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);

                this.isError = false;
                this.alertMessage = `access token copied successfully`
                return this.animateAlert();

            },
            checkImage(image){
                console.log(`image loaded: ${image}`);
            },
        },
    }
</script>

<style scoped lang="scss">
    .card-header {
        font-weight: 900;
        background: #e4e4e4;
    }

    .integerInfo {
        .card {
            min-height: 150px;
            border-radius: 0;
        }
    }

    .copySuccess {
        opacity: 0;
    }
</style>
