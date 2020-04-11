<template>
    <component :is="spinner" />
</template>

<script>
import Bounce from "./Bounce";
import Wave from "./Wave";
import Circle from "./Circle";
import Pulse from "./Pulse";
import ThreeBounce from "./ThreeBounce";
import RotatingPlane from "./RotatingPlane";
import FadingCircle from "./FadingCircle";
import CubicGrid from "./CubicGrid";
import ChasingDots from "./ChasingDots";
import WanderingCubes from "./WanderingCubes";

export default {
    name: "Spinner",
    props: {
        name: {
            type: String,
            default: "bounce"
        }
    },
    computed: {
        spinner() {
            switch (this.name) {
                case "bounce":
                    return Bounce;
                case "wave":
                    return Wave;
                case "circle":
                    return Circle;
                case "pulse":
                    return Pulse;
                case "three-bounce":
                    return ThreeBounce;
                case "wandering-cubes":
                    return WanderingCubes;
                case "rotating-plane":
                    return RotatingPlane;
                case "fading-circle":
                    return FadingCircle;
                case "cubic-grid":
                    return CubicGrid;
                case "chasing-dots":
                    return ChasingDots;
                default:
                    return Bounce;
            }
        }
    }
};
</script>

<style scoped></style>
