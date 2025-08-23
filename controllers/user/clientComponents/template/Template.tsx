import apiTemplate from '../api/template';
import useAppQuery from '../../../client/hooks/useAppQuery';
import useAppEffect from '../../../client/hooks/useAppEffect';
import config from '../../../client/config';

const Template = () => {
    const { error, data, isLoading } = useAppQuery('template_user', apiTemplate.getTemplate);
    useAppEffect(error)
    if (isLoading) return <div>Loading...</div>;
    const template = data?.template_server_url + data?.template.template_url!
    const template_zoom_ratio = config.template_zoom_ratio

    if(data?.template.isActive) {
      return (
        <div className='flex p-5 w-fit'>
          <div className='flex relative rounded-[44px] overflow-hidden' style={{ width: `${template_zoom_ratio * 2.125}px`, height: `${template_zoom_ratio * 3.375}px` }}>
            <div>
              <img src={template}/>
            </div>
            {Object.keys(data.template_info).map((field_ori : string) => {
              let field;
              if (['Name', 'Image', 'Description', 'Organization', 'Position'].includes(field_ori)) {
                field = field_ori.toLowerCase()
              } else {
                field = field_ori
              }
              
              const info = data.user_info[field as keyof typeof data.user_info]
              if(!info) return
              
              const template_info = data.template_info[field_ori as keyof typeof data.template_info]
              if(!template_info.w) return

              return (
                <a key={field} href={info} target='_blank' className='absolute' style={{ width: `${template_zoom_ratio * template_info.w}px`, height: `${template_zoom_ratio * template_info.h}px`, top: `${template_zoom_ratio * template_info.y}px`, left: `${template_zoom_ratio * template_info.x}px`}}></a>
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
