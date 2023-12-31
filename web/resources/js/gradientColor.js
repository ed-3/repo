let colors = [[62, 35, 255], [60, 255, 60], [255, 35, 98], [45, 175, 230], [255, 0, 255], [255, 128, 0]]
  , step = 0
  , colorIndices = [0, 1, 2, 3]
  , gradientSpeed = .002;
function updateGradient() {
    if (void 0 !== $) {
        const col1 = colors[colorIndices[0]]
          , col2 = colors[colorIndices[1]]
          , e = colors[colorIndices[2]]
          , t = colors[colorIndices[3]]
          , c = 1 - step
          , fromColor = "rgb(" + Math.round(c * col1[0] + step * col2[0]) + "," + Math.round(c * col1[1] + step * col2[1]) + "," + Math.round(c * col1[2] + step * col2[2]) + ")"
          , toColor = "rgb(" + Math.round(c * e[0] + step * t[0]) + "," + Math.round(c * e[1] + step * t[1]) + "," + Math.round(c * e[2] + step * t[2]) + ")";
        $("#gradient").css({
            background: "-webkit-gradient(linear, left top, right top, from(" + fromColor + "), to(" + toColor + "))"
        }).css({
            background: "-moz-linear-gradient(left, " + fromColor + " 0%, " + toColor + " 100%)"
        }),
        (step += gradientSpeed) >= 1 && (step %= 1,
        colorIndices[0] = colorIndices[1],
        colorIndices[2] = colorIndices[3],
        colorIndices[1] = (colorIndices[1] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length,
        colorIndices[3] = (colorIndices[3] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length)
    }
}
setInterval(updateGradient, 10);