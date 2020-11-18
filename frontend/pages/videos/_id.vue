<template>
  <div class="user">
    <div class="video-wrap">
        <a href="">
        <div class="play-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 311.69 311.69"><path d="M155.84,0A155.85,155.85,0,1,0,311.69,155.84,155.84,155.84,0,0,0,155.84,0Zm0,296.42A140.58,140.58,0,1,1,296.42,155.84,140.58,140.58,0,0,1,155.84,296.42Z"/><polygon points="218.79 155.84 119.22 94.34 119.22 217.34 218.79 155.84"/></svg>
        </div>
        </a>
        <img class="placeholder" src="https://dummyimage.com/600x400/000/000000" alt="landscape" />
    </div>

    <div class="istia_embed wistia_async_ybyot0dm7q" style="height:349px;width:620px">&nbsp;</div>
    <h3>{{ title }}</h3>
    <h4>{{ category }}</h4>

    <p>{{ description }}</p>
    <p>
      <NuxtLink to="/">
        List of Videos
      </NuxtLink>
    </p>
  </div>

</template>
<script src="//fast.wistia.com/embed/medias/ybyot0dm7q.jsonp" async></script>
<script>
import axios from 'axios'

export default {
  head() {
    return {
        script: [
            { hid: 'stripe', src: '<https//fast.wistia.com/embed/medias/ybyot0dm7q.jsonp>', defer: true },
            { hid: 'stripe', src: '<https//fast.wistia.com/assets/external/E-v1.js>', defer: true },
        ]
    };
  },
  data() {
    return {
        video_ref: "",
    };
  },
  validate ({ params }) {
    return !isNaN(+params.id)
  },
  async asyncData ({ params, error }) {
    try {
      const { data } = await axios.get(`http://localhost:8080/videos/${+params.id}`)
      console.log(data);
      return data.data
    } catch (e) {
      error({ message: 'Video not found', statusCode: 404 })
    }
  }
}
</script>

<style scoped>
/* Just a parent container for the videos */
.videos {
    margin: 20px auto;
    max-width: 700px;
}
/* Individual video container */
.video-wrap {
    position: relative;
    max-width: 700px;
    width: 100%;
    margin-bottom: 10px;
}
/* video poster frame or placeholder image */
.video-wrap .placeholder {
    max-width: 700px;
    width: 100%;
}
/* SVG play button container */
.video-wrap .play-btn {
    position: absolute;
    max-width: 700px;
    width: 100px;
    height: 100px;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}
.video-wrap .play-btn svg {
    transition: all .2s ease;
    fill: #fff;
}
.video-wrap .play-btn:hover svg,
.video-wrap .play-btn:focus svg {
    cursor: pointer;
    fill: #17e617;
}
/* adjust your icon size, add different breakpoints as needed */
@media screen and (max-width: 600px) {
    .video-wrap .play-btn {
    width: 70px;
    height: 70px;
    }
}
</style>