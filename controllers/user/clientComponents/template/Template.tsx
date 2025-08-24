import apiTemplate from '../api/template';
import useAppQuery from '../../../client/hooks/useAppQuery';
import useAppEffect from '../../../client/hooks/useAppEffect';
import config from '../../../client/config';
import AppImage from '../../../client/clientComponents/AppImage';

const Template = () => {
    const { error, data, isLoading } = useAppQuery('template_user', apiTemplate.getTemplate);
    useAppEffect(error)
    if (isLoading) return <div>Loading...</div>;
    const template = data?.template_server_url + data?.template.template_url!;
    const template_zoom_ratio = config.template.zoom_ratio;
    const template_with = config.card_standard.width * template_zoom_ratio;
    const template_height = config.card_standard.height * template_zoom_ratio;
    const template_corner = config.card_standard.corner_radius * template_zoom_ratio;
    const template_text_room_ratio = config.template.text_zoom_ratio

    const textFields = ['Name', 'Image', 'Description', 'Organization', 'Position'];

    if(data?.template.isActive) {
      return (
        <div className='flex p-5 w-fit'>
          <div
            className='flex relative overflow-hidden'
            style={{
              width: `${template_with}px`,
              height: `${template_height}px`,
              borderRadius: `${template_corner}px`
          }}>
            <div>
              <AppImage src={template}/>
            </div>
            {Object.keys(data.template_info).map((field_ori : string) => {
              let field;
              if (textFields.includes(field_ori)) {
                field = field_ori.toLowerCase()
              } else {
                field = field_ori
              }
              
              const info = data.user_info[field as keyof typeof data.user_info]
              if(!info) return
              
              const template_info = data.template_info[field_ori as keyof typeof data.template_info]
              if(!template_info.w) return

              const color = template_info.color ?? 'white'

              return (
                <div
                  key={field}
                  id={field}
                  className='absolute'
                  style={{
                    width: `${template_zoom_ratio * template_info.w}px`,
                    height: `${template_zoom_ratio * template_info.h}px`,
                    top: `${template_zoom_ratio * template_info.y}px`,
                    left: `${template_zoom_ratio * template_info.x}px`,
                    borderRadius: `${field === 'image' ? '50%' : '0px'}`,
                    overflow: `${field === 'image' ? 'hidden' : 'auto'}`,
                    color: `${color}`,
                    fontSize: `${textFields.includes(field_ori) ? template_zoom_ratio * template_text_room_ratio * template_info.h : 0}px`,
                    lineHeight: `1`
                  }}
                  dangerouslySetInnerHTML={{ __html: info.html }}
                />
              )
            })}
          </div>
        </div>
      );
    }

    return (
      <div className='h-[100vh] flex justify-center items-center'>The template is not active</div>
    )
}

export default Template
