import { TextareaControl, Button } from "@wordpress/components";
import { useDispatch, useSelect } from "@wordpress/data";

const OutlineStep = ( { onNext, onBack } ) => {
    const meta = useSelect( ( select ) => select( 'core/editor' ).getEditedPostAttribute( 'meta' ) );

    const { editPost } = useDispatch( 'core/editor' );

    return (
        <>
            <TextareaControl
                label="Create your outline: (use bullet points)"
                value={ meta._writeflow_outline || '' }
                onChange={(value) => 
                    editPost({ meta: { ...meta, _writeflow_outline: value } })
                }
            />
            <Button variant="secondary" onClick={onBack} style={{ marginRight: '8px' }}>← Back to Ideas</Button>
            <Button variant="primary" onClick={onNext}>Start Drafting →</Button>
        </>
    );
};
export default OutlineStep;