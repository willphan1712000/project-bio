import config from "../../config";
import useWindowWidth, { mobile } from "../../hooks/useWindowWidth";

export default function template_dim() {
    const width = useWindowWidth();
    const template_zoom_ratio = config.template.zoom_ratio;
    const card_ratio = config.card_standard.ratio
    const template_padding = 20;

    let template_with;
    let template_height;
    let template_corner;
    let ratio;
    
    
    if(width < mobile) {
      ratio = (width - 2 * template_padding) / (config.card_standard.width)
      template_with = width - 2 * template_padding;
      template_height = template_with / card_ratio;
      template_corner = config.card_standard.corner_radius * ratio;
    } else {
      ratio = template_zoom_ratio
      template_with = config.card_standard.width * ratio;
      template_height = config.card_standard.height * ratio;
      template_corner = config.card_standard.corner_radius * ratio;
    }

    return {
        template_padding,
        template_with,
        template_height,
        template_corner,
        ratio
    }
}