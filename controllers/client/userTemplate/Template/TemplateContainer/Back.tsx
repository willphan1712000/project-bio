import template_dim from '../../hooks/template_dim';
import apiTemplate from '../../api/template';
import useAppQuery from '../../../hooks/useAppQuery';
import AppImage from '../../../clientComponents/AppImage';

const TemplateBack = () => {
    const {
        template_corner,
        template_height,
        template_with,
        template_padding,
        ratio,
    } = template_dim();
    const { data, isLoading } = useAppQuery(
        'template_user',
        apiTemplate.getTemplate
    );

    if (isLoading) return <div>Loading...</div>;

    return (
        <div
            style={{
                display: 'flex',
                width: 'fit-content',
                position: 'relative',
                padding: `${template_padding}px`,
            }}
        >
            <div className="absolute top-[1%] left-[50%] bg-[#fff] rounded-[15px] p-[5px] translate-x-[-50%] z-[99]">
                Back
            </div>
            <div
                className="flex flex-col justify-center items-center bg-white"
                style={{
                    // width: '100%',
                    width: `${template_with}px`,
                    height: `${template_height}px`,
                    borderRadius: `${template_corner}px`,
                }}
            >
                <div style={{ fontSize: 0.19 * ratio }}>
                    {data?.user_info.name?.value}
                </div>
                <div style={{ fontSize: 0.1 * ratio }}>
                    {data?.user_info.position?.value}
                </div>
                <div style={{ fontSize: 0.1 * ratio }}>
                    {data?.user_info.organization?.value}
                </div>

                {/* Divider */}
                <div
                    style={{
                        width: 1.25 * ratio,
                        height: 0.0095 * ratio,
                        margin: 0.095 * ratio,
                        backgroundColor: 'black',
                    }}
                ></div>
                {/* Divider */}

                <div style={{ fontSize: 0.1 * ratio }}>
                    {data?.user_info.Mobile?.value}
                </div>
                <div style={{ width: 0.86 * ratio }}>
                    <AppImage src={data?.user_resources.qrcode} />
                </div>
            </div>
        </div>
    );
};

export default TemplateBack;
