import React from 'react';
import Carousel from 'nuka-carousel';
import './slider.scss';

// https://github.com/FormidableLabs/nuka-carousel


const Slider = () => (
  <Carousel
    autoplay
    autoplayReverse
  >
    <img src="https://static.isodev.ovh/img/kids1.jpeg" alt="kids1" />
    <img src="https://static.isodev.ovh/img/kids2.jpeg" alt="kids2" />
    <img src="https://static.isodev.ovh/img/kids3.jpeg" alt="kids3" />
  </Carousel>
);


export default Slider;
