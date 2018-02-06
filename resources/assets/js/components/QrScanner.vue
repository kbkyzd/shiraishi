<template>
    <div>
        <div class="sidebar">
            <section class="cameras">
                <h2>Cameras</h2>
                <ul>
                    <li v-if="cameras.length === 0" class="empty">No cameras found</li>
                    <li v-for="camera in cameras">
                        <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active">
                            {{ formatName(camera.name) }}
                        </span>
                        <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
                <a @click.stop="selectCamera(camera)">{{ formatName(camera.name) }}</a>
              </span>
                    </li>
                </ul>
            </section>
            <section class="scans">
                <h2>Scans</h2>
                <ul v-if="scans.length === 0">
                    <li class="empty">No scans yet</li>
                </ul>
                <transition-group name="scans" tag="ul">
                    <li v-for="scan in scans" :key="scan.date" :title="scan.content">{{ scan.content }}</li>
                </transition-group>
            </section>
        </div>
        <div class="preview-container">
            <video id="preview"></video>
        </div>
    </div>
</template>

<script>
    import Instascan from 'instascan';

    export default {
        props: ['user'],
        data: () => {
            return {
                scanner: null,
                activeCameraId: null,
                cameras: [],
                scans: []
            }
        },
        mounted() {
            const self = this;
            this.scanner = new Instascan.Scanner({
                video: document.getElementById('preview'),
                scanPeriod: 5,
                mirror: false,
            });

            this.scanner.addListener('scan', (content, image) => {
                window.location.href = content;
            });

            Instascan.Camera.getCameras().then(function(cameras) {
                self.cameras = cameras;
                if (cameras.length > 0) {
                    self.activeCameraId = cameras[0].id;
                    self.scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(e => {
                console.error(e);
            });
        },
        methods: {
            formatName(name) {
                return name || '(unknown)';
            },
            selectCamera(camera) {
                this.activeCameraId = camera.id;
                this.scanner.start(camera);
            }
        }
    }
</script>

<style>
    body, html {
        padding: 0;
        margin: 0;
        font-family: 'Roboto', 'Helvetica Neue', 'Calibri', Arial, sans-serif;
        height: 100%;
    }

    .sidebar {
        background: #eceff1;
        min-width: 250px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        overflow: auto;
    }
    .sidebar h2 {
        font-weight: normal;
        font-size: 1.0rem;
        background: #607d8b;
        color: #fff;
        padding: 10px;
        margin: 0;
    }
    .sidebar ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }
    .sidebar li {
        line-height: 175%;
        white-space: nowrap;
        overflow: hidden;
        text-wrap: none;
        text-overflow: ellipsis;
    }
    .cameras ul {
        padding: 15px 20px;
    }
    .cameras .active {
        font-weight: bold;
        color: #009900;
    }
    .cameras a {
        color: #555;
        text-decoration: none;
        cursor: pointer;
    }
    .cameras a:hover {
        text-decoration: underline;
    }
    .scans li {
        padding: 10px 20px;
        border-bottom: 1px solid #ccc;
    }
    .scans-enter-active {
        transition: background 3s;
    }
    .scans-enter {
        background: yellow;
    }
    .empty {
        font-style: italic;
    }
    .preview-container {
        flex-direction: column;
        align-items: center;
        justify-content: center;
        display: flex;
        width: 100%;
        overflow: hidden;
    }
</style>
