import { TextareaControl, Button } from "@wordpress/components";
import { useDispatch, useSelect } from "@wordpress/data";  

const IdeaStep = ( { onNext } ) => {
    const meta = useSelect( ( select ) => select( 'core/editor' ).getEditedPostAttribute( 'meta' ) );

    const { editPost } = useDispatch( 'core/editor' );

    return (
        <>
            <TextareaControl
                label="Brainstorm your ideas:"
                value={ meta._writeflow_idea || '' }
                onChange={(value) => 
                    editPost({ meta: { ...meta, _writeflow_idea: value } })
                }
            />
            <Button variant="primary" onClick={onNext}>Create Outline →</Button>
        </>
    );
};

export default IdeaStep;