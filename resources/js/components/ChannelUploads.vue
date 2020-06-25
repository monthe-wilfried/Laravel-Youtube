<template>

    <div>
        <input class="d-none" type="file" multiple id="video-files" ref="videos" @change="upload">

        <div v-if="!selected" class="card p-3 d-flex justify-content-center align-items-center">
            <svg onclick="document.getElementById('video-files').click()" width="70" height="70" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 461 461"><path d="M365.26 67.4H95.74A95.74 95.74 0 0 0 0 163.13v134.73a95.74 95.74 0 0 0 95.74 95.74h269.52A95.74 95.74 0 0 0 461 297.87V163.14a95.74 95.74 0 0 0-95.74-95.75zM300.5 237.05l-126.06 60.12a5.06 5.06 0 0 1-7.24-4.57v-124a5.06 5.06 0 0 1 7.34-4.52l126.06 63.88a5.06 5.06 0 0 1-.1 9.09z" fill="#f61c0d"/></svg>
            <p class="text-center">Upload Videos</p>
        </div>

        <div v-else class="card p-3">
            <div class="my-4" v-for="video in videos">
                <div class="progress mb-3">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="{ width: progress[video.name] + '%' }" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">{{ progress[video.name] }}%</div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex justify-content-center align-items-center" style="height: 180px; color: white; font-size: 18px; background-color: grey;">
                            Loading thumbnail ...
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            {{ video.name }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "ChannelUploads",
        props: {
            channel: {
                type: Object,
                required: true,
                default: () => ({})
            }
        },
        data() {
            return {
                selected: false,
                videos: [],
                progress: {}
            }
        },
        methods: {
            upload() {
                this.selected = true

                // Array.from() converts a list to an array
                this.videos = Array.from(this.$refs.videos.files)

                const uploaders = this.videos.map(video => {
                    const form = new FormData()
                    this.progress[video.name] = 0
                    form.append('video', video)
                    form.append('title', video.name)

                    return axios.post('/channels/'+this.channel.id+'/videos', form, {
                        onUploadProgress: (event) => {
                            this.progress[video.name] = Math.ceil((event.loaded / event.total) * 100)

                            // force vuejs to update so that the progress bars can update as the video is uploading
                            this.$forceUpdate()
                        }
                    })
                })


            }
        }

    }
</script>

<style scoped>

</style>
