import apiTemplate from './api/template';
import AppImage from '../clientComponents/AppImage';
import useAppEffect from '../hooks/useAppEffect';
import useAppQuery from '../hooks/useAppQuery';
import template_dim from './hooks/template_dim';

interface Props {
  isAdmin?: boolean
}

const Template = ({ isAdmin = false }: Props) => {
  const { ratio, template_corner, template_height, template_with, template_padding } = template_dim()
  const { error, data, isLoading } = useAppQuery('template_user', apiTemplate.getTemplate);
  useAppEffect(error)
  if (isLoading) return <div>Loading...</div>;
  
  const template = data?.template_server_url + data?.template.template_url!;
  const textFields = ['Name', 'Image', 'Description', 'Organization', 'Position'];
  
    if(data?.template.isActive) {
      return (
        <div className={`flex p-[${template_padding}px] w-fit`}>
          <div
            className='flex relative overflow-hidden'
            style={{
              width: `100%`,
              aspectRatio: `${template_with / template_height}`,
              maxWidth: `${template_with}px`,
              maxHeight: `${template_height}px`,
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

              const template_style = data.user_style

              return (
                <div
                  key={field}
                  id={field}
                  className='absolute'
                  style={{
                    width: `${ratio * template_info.w}px`,
                    height: `${ratio * template_info.h}px`,
                    top: `${ratio * template_info.y}px`,
                    left: `${ratio * template_info.x}px`,
                    borderRadius: `${field === 'image' ? '50%' : '0px'}`,
                    overflow: `${field === 'image' ? 'hidden' : 'auto'}`,
                    color: `${template_style[field as keyof typeof template_style] ? template_style[field as keyof typeof template_style].fontColor : 'white'}`,
                    fontSize: `${template_style[field as keyof typeof template_style] ? template_style[field as keyof typeof template_style].fontSize * 2 : 20}px`,
                    fontFamily: `${template_style[field as keyof typeof template_style] ? template_style[field as keyof typeof template_style].font : 'Google'}`,
                    lineHeight: `1`,
                    textAlign: 'center'
                  }}
                  dangerouslySetInnerHTML={{ __html: isAdmin ? (template_info.isIcon ? info.htmlAdmin : info.htmlAdminWValue) : (template_info.isIcon ? info.html : info.htmlWValue) }}
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
