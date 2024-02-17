import React, { useState } from 'react';
import { ProductAdditionalCost } from '../../types/Product';
import Lottie from 'react-lottie';
import { LottieAnimationName } from '../../types/Common';

import * as Animations from '../../animations';

type LottieAnimationProps = {
    width: number,
    height: number,
    loop?: boolean,
    autoPlay?: boolean,
    animation: LottieAnimationName
}
const LottieAnimation = ({ width, height, loop, autoPlay, animation }: LottieAnimationProps) => {



    function getAnimationByName(name: LottieAnimationName) {
        switch (name) {
            case LottieAnimationName.EMPTY_CART: {
                return Animations.EmptyCart;
            } case LottieAnimationName.LOADING_CART: {
                return Animations.LoadingCart;
            }
            default: {
                return "";
            }
        }
    }


    const defaultOptions = {
        loop: loop,
        autoplay: autoPlay,
        animationData: getAnimationByName(animation),
        rendererSettings: {
            preserveAspectRatio: 'xMidYMid slice'
        }
    };

    return (
        <Lottie
            options={defaultOptions}
            height={height}
            width={width}
        />
    )
}

export default LottieAnimation